<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array(
			'title' => 'Admin Login Area',
			'meta_description' => 'Admin Login, to access user data',
			'scripts' => array('assets/js/jquery-2.2.3.min.js', 'assets/js/admin.js'),
			'styles' => array('assets/css/admin.css'),
			'user_details' => $this->session->get_userdata('user_details')
		);

		$this->load->view('admin_login', $data);
	}

	public function login() {
		$this->form_validation->set_rules('usn', 'Username', 'trim|required|alpha_dash');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required|alpha_dash');

		if ($this->form_validation->run()) {
			$this->load->model('user');
			$user_details = $this->user->get_user_details($_POST['usn'], $_POST['pwd']);
			if ($user_details['pwd'] === md5($_POST['pwd'] . $user_details['salt'])) {
				$this->session->set_userdata('user_details', $user_details);

				echo json_encode(array('success' => true));
			} else {
				echo json_encode(array('success' => false, 'errors' => 'The Username or Password is invalid'));
			}
		} else {
			echo json_encode(array('success' =>false, 'errors' => validation_errors()));
		}
	}

	public function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
	}

	public function import_users() {
		echo json_encode($this->load->view('import_users', '', true));
	}

	public function list_users() {
		$this->load->model('user');

		$data = array(
			'user_details' => $this->user->get_users()
		);

		echo json_encode($this->load->view('list_users', $data, true));
	}

	public function update_user() {}
}
