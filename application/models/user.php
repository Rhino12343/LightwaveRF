<?php
class user extends CI_Model {
	public function get_user_details($usn, $pwd) {
		$this->db->select('user_id, usn, pwd, salt');
		$this->db->from('users');
		$this->db->where('usn', $usn);

		$query = $this->db->get();

		$result = $query->result();

		return array(
			'user_id' => $result[0]->user_id,
			'usn'     => $result[0]->usn,
			'pwd'     => $result[0]->pwd,
			'salt'    => $result[0]->salt,
		);
	}

	public function get_users() {
		$query = $this->db->query("SELECT u.user_id, u.usn, ud.*
		                             FROM users AS u
		                       INNER JOIN user_details AS ud ON u.user_id = ud.user_id");

		return $query->result_array();
	}
}