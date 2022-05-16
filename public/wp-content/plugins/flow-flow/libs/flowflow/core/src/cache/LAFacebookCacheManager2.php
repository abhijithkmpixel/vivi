<?php namespace la\core\cache;
if ( ! defined( 'WPINC' ) ) die;

/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>

 * @link      http://looks-awesome.com
 * @copyright Looks Awesome
 */
class LAFacebookCacheManager2 extends LAFacebookCacheManager {

    public function save( $token, $expires ) {
        $auth = $this->getAuth();
        $auth['facebook_access_token'] = $token;
        $this->db->setOption('fb_auth_options', $auth, true);
        parent::save($token, $expires);
    }

    protected function getRefreshTokenUrl( $access_token ) {
        return "https://flow.looks-awesome.com/service/auth/facebook2.php?code=token_refresh&access_token={$access_token}";
    }

    protected function getNameExtendedAccessToken($expires = false){
        return $expires ? self::$postfix_at_expires : self::$postfix_at;
    }
}