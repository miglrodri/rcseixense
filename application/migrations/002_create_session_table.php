<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_session_table extends CI_Migration {

	public function up() {

		$fields = array(
			'id' => array(
				'type' => 'VARCHAR',
				'constraint' => '40',
				),
			'ip_address' => array(
				'type' => 'VARCHAR',
				'constraint' => '45',
				),
			'timestamp' => array(
				'type' => 'INT',
				'constraint' => '10',
				'default' => '0',
				'unsigned' => TRUE,
				),
			'data' => array(
				'type' => 'BLOB',
				'default' => '',
				),
		);
		
		$this->dbforge->add_field($fields);
		
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('timestamp');

		$this->dbforge->create_table('session');
		//$this->db->query();
		echo '<p>#002 Created session table!</p>';
	}

	public function down() {
		$this->dbforge->drop_table('sessions');
		echo '<p>#002 Deleted session table!</p>';
	}
}
