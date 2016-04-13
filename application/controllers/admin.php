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

	public function login() {}

	public function logout() {}

	public function import_users() {}

	public function list_users() {}

	public function update_user() {}
}
