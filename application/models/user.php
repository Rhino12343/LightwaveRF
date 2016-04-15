<?php
class User extends CI_Model {
	public function get_user_details($usn, $pwd) {
		$this->db->select('user_id, usn, pwd, salt');
		$this->db->from('users');
		$this->db->where('usn', $usn);

		$query = $this->db->get();

		$result = $query->result();

		if (count($result) > 0) {
			return array(
				'user_id' => $result[0]->user_id,
				'usn'     => $result[0]->usn,
				'pwd'     => $result[0]->pwd,
				'salt'    => $result[0]->salt,
			);
		}

		return false;
	}

	public function get_users() {
		$query = $this->db->query("SELECT u.user_id, u.usn, ud.*
		                             FROM users AS u
		                       INNER JOIN user_details AS ud ON u.user_id = ud.user_id");

		return $query->result_array();
	}

	public function import_users($data) {
		$this->db->query("TRUNCATE users");
		$this->db->query("TRUNCATE user_details");

		foreach ($data as $user) {
			$user_id      = $this->db->escape_str($user->id);
			$name         = $this->db->escape_str($user->name);
			$username     = $this->db->escape_str($user->username);
			$email        = $this->db->escape_str($user->email);
			$street       = $this->db->escape_str($user->address->street);
			$suite        = $this->db->escape_str($user->address->suite);
			$city         = $this->db->escape_str($user->address->city);
			$zipcode      = $this->db->escape_str($user->address->zipcode);
			$latitude     = $this->db->escape_str($user->address->geo->lat);
			$longitude    = $this->db->escape_str($user->address->geo->lng);
			$phone        = $this->db->escape_str($user->phone);
			$website      = $this->db->escape_str($user->website);
			$company_name = $this->db->escape_str($user->company->name);
			$catch_phrase = $this->db->escape_str($user->company->catchPhrase);
			$strap_line   = $this->db->escape_str($user->company->bs);

			$sql = "INSERT INTO users VALUES (?, ?, ?, ?)";

			$salt = date('Y-m-d H:i:s');

			$this->db->query($sql, array($user_id, $username, md5($email . $salt), $salt));

			$sql = "INSERT INTO user_details (`user_id`, `name`, `email`, `street`, `suite`, `city`, `zipcode`, `latitude`, `longitude`, `phone`, `website`, `company_name`, `catch_phrase`, `strap_line`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";

			$this->db->query(sprintf($sql,
				$user_id,
				$name,
				$email,
				$street,
				$suite,
				$city,
				$zipcode,
				$latitude,
				$longitude,
				$phone,
				$website,
				$company_name,
				$catch_phrase,
				$strap_line
			));
		}
	}

	public function update_user($data) {
		$updated = false;

		$user_id      = $this->db->escape_str($data['user_id']);
		$name         = $this->db->escape_str($data['name']);
		$username     = $this->db->escape_str($data['username']);
		$email        = $this->db->escape_str($data['email']);
		$street       = $this->db->escape_str($data['street']);
		$suite        = $this->db->escape_str($data['suite']);
		$city         = $this->db->escape_str($data['city']);
		$zipcode      = $this->db->escape_str($data['zipcode']);
		$phone        = $this->db->escape_str($data['phone']);
		$website      = $this->db->escape_str($data['website']);
		$company_name = $this->db->escape_str($data['company_name']);
		$catch_phrase = $this->db->escape_str($data['catch_phrase']);
		$strap_line   = $this->db->escape_str($data['strap_line']);

		$sql = "UPDATE users SET usn = ? WHERE user_id = ?";

		$this->db->query($sql, array($username, $user_id));

		$updated_user = (bool)($this->db->affected_rows() > 0);

		$sql = "UPDATE user_details SET `name` = '%s', `email` = '%s', `street` = '%s', `suite` = '%s', `city` = '%s', `zipcode` = '%s', `phone` = '%s', `website` = '%s', `company_name` = '%s', `catch_phrase` = '%s', `strap_line` = '%s' WHERE user_id = %s";

		$this->db->query(sprintf($sql,
			$name,
			$email,
			$street,
			$suite,
			$city,
			$zipcode,
			$phone,
			$website,
			$company_name,
			$catch_phrase,
			$strap_line,
			$user_id
		));

		$updated_user_details = (bool)($this->db->affected_rows() > 0);

		return (bool) ($updated_user || $updated_user_details);
	}
}