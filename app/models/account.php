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
		echo $sql;
		$stm = $this->db->pdo->prepare($sql);
		foreach ($fields as $column => &$value)
		{
				$stm->bindparam(":" . $column, $value);
		}
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$update = $this->db->execute_pdo($stm, "account", "main");
		return ($update->rowCount());
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
