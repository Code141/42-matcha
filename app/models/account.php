<?php
class m_account 
{
	public function fetch_all_from($table)
	{
		$sql = "
			SELECT *
			FROM " . $table;
		$stm = $this->db->pdo->prepare($sql);
		$selection = $stm->execute();
		$selection = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($selection);
	}

	public function fetch_and_add_gender_id($gender_id_name)
	{
		if (($gender_id_name = trim($gender_id_name)) == "")
			return FALSE;
		$sql = "
			SELECT id
			FROM gender_identity gi
			WHERE gi.gender_identity_name = :gender_id_name";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":gender_id_name", $gender_id_name);
		$this->db->execute_pdo($stm, "account", "main");
		if ($stm->rowCount() == 0)
		{
			$sql = "
				INSERT INTO `gender_identity`(`id`, `gender_identity_name`) 
				VALUES (NULL, :gender_id_name )";
			$stm = $this->db->pdo->prepare($sql);
			$stm->bindparam("gender_id_name", $gender_id_name);
			$this->db->execute_pdo($stm, "account", "main");
			$sql = "
				SELECT id
				FROM `gender_identity` 
				WHERE gender_identity_name = :gender_id_name";
			$stm = $this->db->pdo->prepare($sql);
			$stm->bindparam("gender_id_name", $gender_id_name);
			$select = $this->db->execute_pdo($stm, "account", "main");
		}
		return ($stm->fetch()[0]);
	}

	public function update_user($id_user, $fields)
	{
		$set = "";
		foreach ($fields as $column => $value)
		{
			$set .= $column . " = :" . $column . " , ";
		}
		$set = rtrim($set," , ");
		$sql = "
			UPDATE user u
			SET " . $set . 
			" WHERE id = :id_user";
		$stm = $this->db->pdo->prepare($sql);
		foreach ($fields as $column => &$value)
		{
				$stm->bindparam(":" . $column, $value);
		}
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$update = $this->db->execute_pdo($stm, "account", "main");
		return ($update->rowCount());
	}

	public function edit_bio($id_user, $bio)
	{
		$sql = "
			INSERT INTO bio (id_user, bio)
			VALUES ( :id , :bio1 )
			ON DUPLICATE KEY UPDATE
			bio = :bio2";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":id", $id_user);
		$stm->bindparam(":bio1", $bio);
		$stm->bindparam(":bio2", $bio);
		$this->db->execute_pdo($stm, "account", "main");
		return (TRUE);
	}
	
	public function del_preference($id_user, $id_gender, $id_gender_identity)
	{
		$sql = "
			DELETE FROM user_orientation 
			WHERE id_user = :id_user
			AND id_gender = :id_gender
			AND id_gender_identity = :id_gender_identity";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":id_user", $id_user);
		$stm->bindparam(":id_gender", $id_gender);
		$stm->bindparam(":id_gender_identity", $id_gender_identity);
		$this->db->execute_pdo($stm, "account", "main");
		return (TRUE);
	}
	
	public function add_preference($id_user, $id_gender, $id_gender_identity)
	{
		$sql = "
			INSERT INTO user_orientation (id_user, id_gender, id_gender_identity)
			SELECT user.id, g.id, gi.id
			FROM gender g

			LEFT OUTER JOIN user
			ON user.id = :id_user

			LEFT OUTER JOIN gender_identity gi
			ON gi.id = :id_gender_identity

			LEFT OUTER JOIN user_orientation uo
			ON uo.id_user = :id_user
			AND uo.id_gender = :id_gender
			AND uo.id_gender_identity = :id_gender_identity

			WHERE g.id = :id_gender
			AND uo.id_gender is NULL
			AND uo.id_gender_identity is NULL
			AND uo.id_user is NULL";
		echo $sql;
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":id_user", $id_user);
		$stm->bindparam(":id_gender", $id_gender);
		$stm->bindparam(":id_gender_identity", $id_gender_identity);
		$this->db->execute_pdo($stm, "account", "main");
		if ($stm->rowCount())
			return (TRUE);
		return (FALSE);
	}
	
	public function del_tag($id_user, $id_tag)
	{
		$sql = "
			DELETE FROM user_tags 
			WHERE id_user = :id_user
			AND id_tag = :id_tag";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":id_user", $id_user);
		$stm->bindparam(":id_tag", $id_tag);
		$this->db->execute_pdo($stm, "account", "main");
		return (TRUE);
	}

	public function add_tag($id_user, $tag_name)
	{
		$sql = "SELECT id
				FROM tag
				WHERE tag_name = :tag_name";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":tag_name", $tag_name);
		$this->db->execute_pdo($stm, "account", "main");
		if (!$id_tag = $stm->fetch()[0])
		{
			$sql = "
				INSERT INTO tag (id, tag_name)
				VALUES ( NULL , :tag_name )";
			$stm = $this->db->pdo->prepare($sql);
			$stm->bindparam(":tag_name", $tag_name);
			$this->db->execute_pdo($stm, "account", "main");
			$id_tag = $this->db->pdo->lastInsertId();
		}
		$sql = "
		INSERT INTO user_tags (id_user, id_tag)
		SELECT DISTINCT u.id, t.id
		FROM tag t
		LEFT OUTER JOIN user u
		ON u.id = :id_user
		LEFT OUTER JOIN user_tags ut
		ON ut.id_tag = :id_tag AND ut.id_user = :id_user
		WHERE t.id = :id_tag
		AND ut.id_tag IS NULL 
		AND ut.id_user IS NULL";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":id_tag", $id_tag);
		$stm->bindparam(":id_user", $id_user);
		$this->db->execute_pdo($stm, "account", "main");
		if ($stm->rowCount())
			return (TRUE);
		return (FALSE);
	}

	public function change_email($new_email, $token)
	{
		$sql = "
			UPDATE user u
			SET email = :new_email1 , new_email = NULL, token_email = NULL
			WHERE new_email = :new_email2 AND token_email = :token";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":new_email1", $new_email);
		$stm->bindparam(":new_email2", $new_email);
		$stm->bindparam(":token", $token);
		$this->db->execute_pdo($stm, "login", "main");
		return ($stm->rowCount());
	}
}
