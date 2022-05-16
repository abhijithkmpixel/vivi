<?php namespace flow\db\migrations;
use la\core\db\LADDLUtils;
use la\core\db\migrations\ILADBMigration;

if ( ! defined( 'WPINC' ) ) die;
/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright Looks Awesome
 */
class FFMigration_2_4 implements ILADBMigration{

	public function version() {
		return '2.4';
	}

	public function execute($conn, $manager) {
        LADDLUtils::addColumnIfNotExist($conn, $manager->streams_table_name, 'status', 'INT DEFAULT 0');
        $conn->query('DELETE FROM ?n', $manager->cache_table_name);
	}
}