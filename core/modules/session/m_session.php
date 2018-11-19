<?php

class m_module_session
{
	public function new_user($user)
	{
		$sql = "
			INSERT INTO user
			(username, firstname, lastname, birthdate, password, email, token_account)
			VALUES
			(:username, :firstname, :lastname, :birthdate, :password, :email, :token_account)
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("username", $user['username'], PDO::PARAM_STR);
		$stm->bindparam("firstname", $user['firstname'], PDO::PARAM_STR);
		$stm->bindparam("lastname", $user['lastname'], PDO::PARAM_STR);
		$stm->bindparam("birthdate", $user['birthdate'], PDO::PARAM_STR);
		$stm->bindparam("password", $user['encrypted_password'], PDO::PARAM_STR);
		$stm->bindparam("email", $user['email'], PDO::PARAM_STR);
		$stm->bindparam("token_account", $user['token_account'], PDO::PARAM_STR);
		$stm->execute();
		return (NULL);
	}

	public function get_user_by_login($username)
	{
		$sql = "
			SELECT *
			FROM user
			WHERE username = :username
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("username", $username, PDO::PARAM_STR);
		$user = $stm->execute();
		$user = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($user) == 1)
			return ($user[0]);
		return (NULL);
	}

	public function get_user_by_email($username)
	{
		$sql = "
			SELECT *
			FROM user
			WHERE email = :email
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("email", $username, PDO::PARAM_STR);
		$stm->execute();
		$user = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($user) == 1)
			return ($user[0]);
		return (NULL);
	}

	public function reset_token_account($email)
	{
		$sql = "
			UPDATE user
			SET token_account = NULL, account_valid = 1
			WHERE email = :email
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("email", $email, PDO::PARAM_STR);
		$stm->execute();
		return (NULL);
	}

	public function is_taken_mail($email)
	{
		$sql = "
			SELECT *
			FROM user
			WHERE email = :email
			OR new_email = :email
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("email", $email, PDO::PARAM_STR);
		$user = $stm->execute();
		$user = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($user) == 0)
			return (FALSE);
		return (TRUE);
	}

}
