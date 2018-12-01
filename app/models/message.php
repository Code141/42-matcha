<?php

//		id		id_user_from		id_user_to		msg		datetime	seen 

class m_message
{
	public function get_msg($id_conv, $id_user)
	{
		$sql = "
			SELECT msg.*,
				u1.id as id_user_from, u2.id as id_user_to,
				u1.username as username_from, u2.username as username_to
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

	public function get_conv($id_user)
	{
		$sql = "
			SELECT conv.*, SUBSTRING(msg.msg, 1, 40) as last_msg, msg.seen,
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
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$all_conv = $stm->execute();
		$all_conv = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($all_conv);
	}
}
