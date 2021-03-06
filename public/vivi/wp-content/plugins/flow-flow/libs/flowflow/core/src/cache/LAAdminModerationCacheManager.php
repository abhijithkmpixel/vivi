<?php namespace la\core\cache;
if ( ! defined( 'WPINC' ) ) die;

use Exception;

/**
 * FlowFlow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright Looks Awesome
 */
class LAAdminModerationCacheManager extends LACacheManager {
    function __construct( $context = null, $force = false ) {
        parent::__construct( $context, $force );
    }

    public function moderate() {
        $conn = $this->db->conn();
        try {
            if ($conn->beginTransaction()){
                $hash       = $_POST['hash'];
                $action     = $_POST['moderation_action'];
                $stream_id  = $_POST['stream'];
                $feeds = [];
                $stream = $this->db->getStream($stream_id);
                foreach ( $stream['feeds'] as $feed ) {
                    $feeds[] = $feed['id'];
                }

                $commonPartOfSql = $conn->parse("`feed_id` in (?a) AND `creation_index` <= ?i", $feeds, $this->decodeHash($hash));
                $additionalPartOfSql = $conn->parse("`post_status` = 'new'");
                $status = $action == 'new_posts_approve' ? 'approved' : 'disapproved';
                $this->db->setPostStatus($status, $conn->parse('WHERE ?p AND ?p', $commonPartOfSql, $additionalPartOfSql));
                if (isset($_POST['changed'])){
                    $creation_index = time();
                    $commonPartOfSql = $conn->parse("`feed_id` in (?a)", $feeds);
                    foreach ( $_POST['changed'] as $id => $item ) {
                        $status = ($item['approved'] === "true") ? 'approved' : 'disapproved';
                        $this->db->setPostStatus($status, $conn->parse('WHERE ?p AND `post_id` = ?s', $commonPartOfSql, $id), $creation_index);
                    }
                }
                $conn->commit();
            }
            $conn->rollbackAndClose();
            die();
        } catch ( Exception $e ){
            $conn->rollbackAndClose();
            die($e->getMessage());
        }
    }

    protected function getGetFields() {
        $select = parent::getGetFields();
        $select .= ', post.post_status';
        return $select;
    }

    protected function getGetFilters() {
        $args = parent::getGetFilters();
        $args[] = $this->db->conn()->parse('post.post_status != ?s', 'new');
        return $args;
    }

    protected function buildPost( $row, $moderation = false ) {
        $post = parent::buildPost( $row, $moderation );
        $post->status = $row['post_status'];
        return $post;
    }

    protected function getOnlyNew($moderation) {
        $result = parent::getOnlyNew($moderation);
        $filters = parent::getGetFilters();
        $filters[] = $this->db->conn()->parse('post.post_status = ?s', 'new');
        $resultFromDB = $this->db->getPostsIf2($this->getGetFields(), implode(' AND ', $filters));
        if (false === $resultFromDB) $resultFromDB = [];
        foreach ( $resultFromDB as $row ) {
            $result[] = $this->buildPost($row, $moderation[$row['feed_id']]);
        }
        return $result;
    }
}