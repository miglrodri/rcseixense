<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index() {
		// TODO preserve the values if there was POST request
		$this->load->view('login');
	}

	public function submit() {
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		//redirect(base_url().'install/schema');
		$this->auth();
	}

	private function _submit_validate() {
		//$this->form_validation->set_rules('username', 'Username','trim|required|callback_authenticate');
		//$this->form_validation->set_rules('password', 'Password','trim|required');
		//$this->form_validation->set_message('authenticate','Invalid login. Please try again.');

		//return $this->form_validation->run();
	}

	/*
	 * Return
	 * true - if login correct
	 * false - if error on login
	 */
	public function auth() {
		// form deve chamar este controller?
		//return Current_User::login($this->input->post('username'), $this->input->post('password'));
		//return Current_User::login('miguel', '1234567');
		$this->session->set_userdata('email', 'miguel');
		$this->session->set_userdata('id', '17');
		redirect(base_url());
		//return true;
	}
}