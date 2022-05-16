<?php namespace flow\db\migrations;

use la\core\db\LADDLUtils;
use la\core\db\migrations\ILADBMigration;

if ( ! defined( 'WPINC' ) ) die;

/**
 * Flow-Flow
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>
 *
 * @link      http://looks-awesome.com
 * @copyright Looks Awesome
 */
class FFMigration_3_11 implements ILADBMigration {

	public function version() {
		return '3.11';
	}

	public function execute( $conn, $manager ) {
        LADDLUtils::addColumnIfNotExist($conn, $manager->cache_table_name, 'send_email', 'INT DEFAULT 0 NOT NULL');
	}
}