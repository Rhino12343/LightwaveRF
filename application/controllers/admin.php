<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array(
			'title' => 'Admin Login Area',
			'meta_description' => 'Admin Login, to access importing data',
			'scripts' => array('assets/js/jquery-2.2.3.min.js', 'assets/js/admin.js'),
			'styles' => array('assets/css/admin.css')
		);

		$this->load->view('admin_login', $data);
	}

	public function login() {
		$this->form_validation->set_rules('usn', 'Username', 'required');
		$this->form_validation->set_rules('pwd', 'Password', 'required');

		if ($this->form_validation->run()) {
			echo json_encode(array('success' => true));
		} else {
			echo json_encode(array('success' =>false, 'errors' => validation_errors()));
		}
	}

	public function logout() {}

	public function import_users() {}

	public function list_users() {
		echo "this is the new content";
	}

	public function update_user() {}
}
