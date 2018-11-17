<?php

class m_sql_test extends m_wrapper
{
	public $sql;

	public function test()
	{
		$this->select(array("user" => "username"),"user")->where("user","id", "=" , "1");
		$this->db->sql = $this->sql; 
		$this->data['sql'] = $this->db->sql;
		var_dump($this->data['sql']);
		echo "<br>";
		$result = $this->db->execute_pdo()->fetch(PDO::FETCH_ASSOC);
		return ($result);
	}

	public function all_matches()
	{
		$id = 1;
		$this->db->sql =
		"SELECT DISTINCT ug2.id_user
		FROM user_orientation uo1
		LEFT JOIN user_gender ug1
		ON ug1.id_user = uo1.id_user
		LEFT JOIN user_gender ug2
		ON ug2.id_gender = uo1.id_gender
		LEFT JOIN user_orientation uo2
		ON uo2.id_user = ug2.id_user
		WHERE uo1.id_gender = ug2.id_gender
		AND uo2.id_gender = ug1.id_gender
		AND uo1.id_user = :" . $id .
		" ORDER BY ug2.id_user ASC";

		$this->db->bind_param[":" . $id] = $id;
	}
	
	public function all_matches_sort_by_tags()
	{
		$this->all_matches();
	}
	
	public function user_from_username()
	{
		$username = "biornso";

		$this->db->sql =
			"SELECT u.id, u.username, u.firstname, u.lastname, u.birthdate,
			u.account_valid, u.id_media, ua.password, ua.email, ua.new_email,
			ua.token_email, ua.token_password, ua.token_account
			FROM user u
			LEFT JOIN user_account ua
			ON ua.id_user = u.id 
			WHERE u.username = :" . $username;
	
		$this->db->bind_param[":" . $username] = $username;
	}

	public function redundant_orientations()
	{
		$this->db->sql =
			"SELECT uo1.id_user, uo1.id_gender, uo1.id_gender_identity
			FROM user_orientation uo1 
			
			JOIN user_orientation uo2 
			ON (uo2.id_gender = uo1.id_gender 
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender_identity = 0
			AND NOT uo1.id_gender_identity = 0))
			
			OR (uo2.id_gender_identity = uo1.id_gender_identity 
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender = 0
			AND NOT uo1.id_gender = 0))
			
			
			
			ORDER BY uo1.id_user, uo1.id_gender, uo1.id_gender_identity ASC";
	}

	public function delete_redundant_orientations()
	{
		$this->db->sql = 
			"DELETE uo1
			FROM user_orientation uo1

			INNER JOIN user_orientation uo2
			ON (uo2.id_gender = uo1.id_gender
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender_identity = 0
			AND NOT uo1.id_gender_identity = 0))

			OR (uo2.id_gender_identity = uo1.id_gender_identity
			AND (uo2.id_user = uo1.id_user
			AND uo2.id_gender = 0
			AND NOT uo1.id_gender = 0))";
	}
}
