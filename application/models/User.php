<?php

class User extends CI_Model {

	public function login($email, $password) {
		$where = array(
			'email'=>$email,
			'hashed_pass'=>sha1($password)
		);
		$this->db->select()->from('users')->where($where);
		$query = $this->db->get();
		
		if ($result = $query->first_row('array')) {
			return $result;
		}
		return false;
	}

	public function signup($email, $password) {
		$now = new DateTime();
		$data = array(
			'email' => $email,
			'hashed_pass' => sha1($password),
			'created_at' => $now->format('Y-m-d H:i:s'),
			'modified_at' => $now->format('Y-m-d H:i:s'),
				);
		$this->insert($data);
	}

	public function getAll() {
		$this->db->select()->from('users');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getById($id) {
		$this->db->select()->from('users')->where(array('id'=>$id));
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function getByEmail($email) {
		$this->db->select()->from('users')->where(array('email'=>$email));
		$query = $this->db->get();
		return $query->first_row('array');
	}

	public function insert($data) {
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function truncate() {
		$this->db->truncate('users');
	}

}