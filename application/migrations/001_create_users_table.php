<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_table extends CI_Migration {

	public function up() {
		$this->dbforge->add_field('id');
		
		$fields = array(
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				),
			'hashed_pass' => array(
				'type' =>'VARCHAR',
				'constraint' => '100',
				),
			'name' => array(
				'type' => 'TEXT',
				'null' => TRUE,
			),
		);
		
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field('created_at DATETIME NOT NULL');
		$this->dbforge->add_field('modified_at DATETIME NOT NULL');
		
		$this->dbforge->create_table('users');
		echo '<p>#001 Created users table!</p>';
	}

	public function down() {
		$this->dbforge->drop_table('users');
		echo '<p>#001 Deleted users table!</p>';
	}
}