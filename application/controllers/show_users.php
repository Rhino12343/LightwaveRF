<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Show_users extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array(
			'title' => 'User List',
			'meta_description' => 'View all users in the system',
			'scripts' => array('assets/js/jquery-2.2.3.min.js', 'assets/js/jquery-ui.min.js', 'assets/js/user_list.js'),
			'styles' => array('assets/css/user_list.css', 'assets/css/jquery-ui.min.css', 'assets/css/jquery-ui.structure.min.css', 'assets/css/jquery-ui.theme.min.css'),
			'show_users' => $this->session->get_userdata('show_users')
		);

		$this->load->view('show_users', $data);
	}

	public function login() {
		$this->form_validation->set_rules('usn', 'Username', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');

		if ($this->form_validation->run()) {
			$this->load->model('user');
			$user_details = $this->user->get_user_details($this->input->post('usn'), $this->input->post('pwd'));
			if (is_array($user_details) && $user_details['pwd'] === md5($this->input->post('pwd') . $user_details['salt'])) {
				$this->session->set_userdata('show_users', $user_details);

				echo json_encode(array('success' => true));
			} else {
				echo json_encode(array('success' => false, 'errors' => 'The Username or Password is invalid'));
			}
		} else {
			echo json_encode(array('success' => false, 'errors' => validation_errors()));
		}
	}

	public function logout() {
		$this->session->unset_userdata('show_users');
		session_destroy();
	}

	public function list_users() {
		if (isset($this->session->get_userdata('show_users')['show_users'])) {
			$this->load->model('user');

			$data = array(
				'user_details' => $this->user->get_users()
			);

			echo json_encode($this->load->view('list_users', $data, true));
		} else {
			redirect('/show_users', 'location');
		}
	}
}
