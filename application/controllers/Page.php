<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index() {
		//$this->output->enable_profiler(TRUE);
		$this->load->library('session');
		$data['user_id'] = $this->session->userdata('id');
		$data['user_email'] = $this->session->userdata('email');
		$data['page_title'] = 'Homepage';
		//var_dump($data);
		$this->load->view('templates/header', $data);
		$this->load->view('homepage', $data);
		$this->load->view('templates/footer');
	}

	public function old_index() {
		//$this->output->enable_profiler(TRUE);
		$data['env'] = ENVIRONMENT;
		$data['url'] = $_SERVER['SERVER_NAME'];
		$this->db->reconnect();
		$data['config'] = $this->db;
		$services_json = json_decode(getenv("VCAP_SERVICES"),true);
		$data['mysql_config'] = $services_json["mysql-5.1"][0]["credentials"];

		//echo print_r($data);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		//$this->load->view('welcome_message');
	}
}
