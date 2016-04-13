<?php
class user extends CI_Model {
	public function login($usn, $pwd) {
		$this->db->select('user_id, usn, pwd, salt');
		$this->db->from('users');
		$this->db->where('usn', $usn);

		$result = $this->db->get();

		var_dump($result);
	}
}