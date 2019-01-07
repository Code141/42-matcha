<?php

class m_module_session
{
	public function new_user($user)
	{
		$sql = "
			INSERT INTO user
			(username, firstname, lastname, birthdate, id_gender, password, email, token_account)
			VALUES
			(:username, :firstname, :lastname, :birthdate, :id_gender, :password, :email, :token_account)
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("username", $user['username'], PDO::PARAM_STR);
		$stm->bindparam("firstname", $user['firstname'], PDO::PARAM_STR);
		$stm->bindparam("lastname", $user['lastname'], PDO::PARAM_STR);
		$stm->bindparam("birthdate", $user['birthdate'], PDO::PARAM_STR);
		$stm->bindparam("id_gender", $user['id_gender'], PDO::PARAM_STR);
		$stm->bindparam("password", $user['encrypted_password'], PDO::PARAM_STR);
		$stm->bindparam("email", $user['email'], PDO::PARAM_STR);
		$stm->bindparam("token_account", $user['token_account'], PDO::PARAM_STR);
		$stm->execute();
		return (NULL);
	}

	public function get_user_orientations($id_user)
	{
		$sql = "
			SELECT uo.id_gender, g.gender_name, uo.id_gender_identity, gi.gender_identity_name
			FROM user_orientation uo
			LEFT JOIN gender g
			ON uo.id_gender = g.id
			LEFT JOIN gender_identity gi
			ON uo.id_gender_identity = gi.id
			WHERE uo.id_user = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$stm->execute();
		$orientation = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($orientation);
	}

	public function get_user_tags($id_user)
	{
		$sql = "
			SELECT t.tag_name, t.id
			FROM user_tags ut
			LEFT JOIN tag t
			ON t.id = ut.id_tag
			WHERE ut.id_user = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$stm->execute();
		$tags = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($tags);
	}

	public function get_user_media($id_user)
	{
		$sql = "
			SELECT id_media
			FROM media
			WHERE id_user = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$stm->execute();
		$medias = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($medias);
	}

	public function get_bio($id_user)
	{
		$sql = "
			SELECT bio
			FROM bio
			WHERE id_user = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$stm->execute();
		$bio = $stm->fetch()['bio'];
		return ($bio);
	}

	public function get_user_by_login($username)
	{
		$sql = "
			SELECT u.*, g.gender_name, gi.gender_identity_name 
			FROM user u
			LEFT JOIN gender g
			ON u.id_gender = g.id
			LEFT JOIN gender_identity gi
			ON u.id_gender_identity = gi.id
			WHERE u.username = :username
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
			SET token_account = NULL
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
			WHERE email = :email";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("email", $email, PDO::PARAM_STR);
		$user = $stm->execute();
		$user = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($user) == 0)
			return (FALSE);
		return (TRUE);
	}

	public function is_valid_id_gender($id_gender)
	{
		$sql = "
			SELECT *
			FROM gender
			WHERE id = :id_gender
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_gender", $id_gender, PDO::PARAM_INT);
		$gender = $stm->execute();
		$gender = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($gender) == 0)
			return (FALSE);
		return (TRUE);
	}

	public function reset_password($username, $token)
	{
		$sql = "
			UPDATE user
			SET token_password = :token
			WHERE username = :username
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("username", $username, PDO::PARAM_STR);
		$stm->bindparam("token", $token, PDO::PARAM_STR);
		$stm->execute();
		if ($stm->rowCount() != 1)
			return (FALSE);
		return (TRUE);
	}

}
