<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schema extends CI_Controller {

	function __construct(){
		parent::__construct();

		// can only be run in the development environment
		if (ENVIRONMENT !== 'development') {
			//exit('Wowsers! You don\'t want to do that!');
		}
 
		// load any required models
		$this->load->model('user');
	}

	function index() {
		// get table names:

		//$this->db->select()->from('users');
		//$query = $this->db->get();

		$data['database_name'] = $this->db->database;
		$value_name = 'Tables_in_'. $data['database_name'];

		//$query = $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='". $this->db->database ."';");
		$query = $this->db->query('SHOW TABLES;');
		$table_names_array = $query->result_array();
		
		$table_names = array();

		foreach ($table_names_array as $key => $value) {
			# code...
			array_push($table_names, $value[$value_name]);
			//$data[] = $value;
			//echo print_r($value[$value_name]);
		}

		//$data['table_names_array'] = $table_names;
		//print_r($data);

		foreach ($table_names as $table) {
			$table_fields = array();
			$temp_query = $this->db->query('DESCRIBE '. $table .';');
			$result = $temp_query->result_array();
			foreach ($result as $field) {
					array_push($table_fields, $field['Field'] .' | type:'. $field['Type']);
				}	

			$data[$table] = $table_fields;
			//$data[$table] = $result;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function users() {
		$data = $this->user->getAll();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

//SELECT TABLE_NAME 
//FROM INFORMATION_SCHEMA.TABLES
//WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='dbName'