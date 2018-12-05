<?php

class m_message
{
	public function send_msg($id_conv, $id_user_from, $id_user_to, $msg)
	{
		$sql = "
			INSERT INTO msg
			(id_conv, id_user_from, id_user_to, msg)
			VALUES
			(:id_conv, :id_user_from, :id_user_to, :msg)
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_conv", $id_conv, PDO::PARAM_INT);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$stm->bindparam("msg", $msg, PDO::PARAM_STR);
		$stm->execute();
		return (NULL);
	}

	public function seen($id_conv, $id_user)
	{
		$sql = "
			UPDATE msg
			SET
			seen = 1
			WHERE id_user_to = :id_user_to
			AND id_conv = :id_conv
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_conv", $id_conv, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user, PDO::PARAM_INT);
		$stm->execute();
		return (NULL);
	}

	public function get_msg($id_conv, $id_user)
	{
		$sql = "
			SELECT msg.*,
				u1.id as id_user_from, u2.id as id_user_to,
				u1.username as username_from, u2.username as username_to,
				(CASE WHEN u1.id = :id_user THEN u2.id_media ELSE u1.id_media END) AS id_media
			FROM msg
			LEFT JOIN user u1
			ON msg.id_user_from = u1.id
			LEFT JOIN user u2
			ON msg.id_user_to = u2.id
			WHERE msg.id_conv = :id_conv
			AND (msg.id_user_to = :id_user OR msg.id_user_from = :id_user)
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_conv", $id_conv, PDO::PARAM_INT);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$msgs = $stm->execute();
		$msgs = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($msgs);
	}

	public function is_user_conv($id_conv, $id_user)
	{
		$sql = "
				SELECT *,
				(CASE WHEN conv.id_user_from = :id_user
					THEN conv.id_user_to
					 ELSE conv.id_user_from END) AS id_user
				FROM conv
				WHERE id = :id_conv
				AND (id_user_from = :id_user
				OR id_user_to = :id_user)
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_conv", $id_conv, PDO::PARAM_INT);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$stm->execute();
		$conv = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (!$stm->rowCount())
			return (NULL);
		return ($conv[0]);
	}

	public function get_conv($id_user)
	{
		$sql = "
			SELECT conv.id,
				msg.datetime,
				msg.id_user_from,
				SUBSTRING(msg.msg, 1, 40) as last_msg,
				msg.seen,
				(CASE WHEN u1.id = :id_user THEN u2.username ELSE u1.username END) AS username,
				(CASE WHEN u1.id = :id_user THEN u2.id ELSE u1.id END) AS id_user,
				(CASE WHEN u1.id = :id_user THEN u2.id_media ELSE u1.id_media END) AS id_media
			FROM conv
			LEFT JOIN user u1
			ON conv.id_user_from = u1.id
			LEFT JOIN user u2
			ON conv.id_user_to = u2.id
			LEFT JOIN msg
			ON msg.id_conv = conv.id
			LEFT OUTER JOIN msg m2
			ON (msg.id < m2.id AND msg.id_conv = m2.id_conv)
			WHERE m2.id is NULL
			AND (conv.id_user_from = :id_user OR conv.id_user_to = :id_user)
			ORDER BY msg.datetime DESC
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$all_conv = $stm->execute();
		$all_conv = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($all_conv);
	}
}
