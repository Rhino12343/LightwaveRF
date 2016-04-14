<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data = array(
			'title' => 'Admin Area',
			'meta_description' => 'Admin Area, to access user data',
			'scripts' => array('assets/js/jquery-2.2.3.min.js', 'assets/js/jquery-ui.min.js', 'assets/js/admin.js'),
			'styles' => array('assets/css/admin.css', 'assets/css/jquery-ui.min.css', 'assets/css/jquery-ui.structure.min.css', 'assets/css/jquery-ui.theme.min.css'),
			'user_details' => $this->session->get_userdata('user_details')
		);

		$this->load->view('admin_login', $data);
	}

	public function login() {
		$this->form_validation->set_rules('usn', 'Username', 'trim|required');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');

		if ($this->form_validation->run()) {
			$this->load->model('user');
			$user_details = $this->user->get_user_details($this->input->post('usn'), $this->input->post('pwd'));
			if (is_array($user_details) && $user_details['pwd'] === md5($this->input->post('pwd') . $user_details['salt'])) {
				$this->session->set_userdata('user_details', $user_details);

				echo json_encode(array('success' => true));
			} else {
				echo json_encode(array('success' => false, 'errors' => 'The Username or Password is invalid'));
			}
		} else {
			echo json_encode(array('success' => false, 'errors' => validation_errors()));
		}
	}

	public function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
	}

	public function import_users() {
		if (isset($this->session->get_userdata('user_details')['user_details'])) {
			if ($this->input->post('execute') !== null && $this->input->post('execute')) {

				$this->load->model('user');

				$ch = curl_init('http://jsonplaceholder.typicode.com/users');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$data = json_decode(curl_exec($ch));
				curl_close($ch);

				$this->user->import_users($data);

				echo json_encode(array('success' => true));
			} else {
				echo json_encode($this->load->view('import_users', '', true));
			}
		} else {
			redirect('/admin', 'location');
		}
	}

	public function list_users() {
		if (isset($this->session->get_userdata('user_details')['user_details'])) {
			$this->load->model('user');

			$data = array(
				'user_details' => $this->user->get_users()
			);

			echo json_encode($this->load->view('list_users', $data, true));
		} else {
			redirect('/admin', 'location');
		}
	}

	public function edit_user() {
		if (isset($this->session->get_userdata('user_details')['user_details'])) {
			$this->load->model('user');

			if ($this->input->post('update') !== null && $this->input->post('update')) {
				$data = array(
					'user_id'      => $this->input->post('user_id'),
					'name'         => $this->input->post('name'),
					'username'     => $this->input->post('username'),
					'email'        => $this->input->post('email'),
					'suite'        => $this->input->post('suite'),
					'street'       => $this->input->post('street'),
					'city'         => $this->input->post('city'),
					'zipcode'      => $this->input->post('zipcode'),
					'phone'        => $this->input->post('phone'),
					'website'      => $this->input->post('website'),
					'company_name' => $this->input->post('company_name'),
					'catch_phrase' => $this->input->post('catch_phrase'),
					'strap_line'   => $this->input->post('strap_line'),
				);

				echo json_encode(array('success' => $this->user->update_user($data)));
			} else {

				$data = array(
					'user_details' => $this->user->get_users()
				);

				echo json_encode($this->load->view('edit_user', $data, true));
			}
		} else {
			redirect('/admin', 'location');
		}
	}
}
