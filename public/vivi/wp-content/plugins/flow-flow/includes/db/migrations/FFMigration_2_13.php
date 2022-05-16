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
class FFMigration_2_13 implements ILADBMigration{

	public function version() {
		return '2.13';
	}

	public function execute($conn, $manager) {
		LADDLUtils::addColumnIfNotExist($conn, $manager->posts_table_name, 'post_additional', 'VARCHAR(300)');
	}
}