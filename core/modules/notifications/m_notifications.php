<?php

class m_module_notifications
{
	public function get_history($id_user)
	{
		$sql = "
			SELECT bh.*, u.username, u.id
			FROM browsing_history bh
			LEFT JOIN user u
			ON u.id = bh.id_user_from
			WHERE bh.id_user_to = :id_user
			ORDER BY bh.timestamp DESC
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$history = $stm->execute();
		$history = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($history);
	}

	public function get_like($id_user)
	{
		$sql = "
			SELECT l.*, u.username, u.id
			FROM `like` l
			LEFT JOIN user u
			ON u.id = l.id_user_from
			WHERE l.id_user_to = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$history = $stm->execute();
		$history = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($history);
	}

	public function revoke($id_user)
	{
		$sql = "
			SELECT l.*, u.username, u.id, l2.revoked
			FROM `like` l
			LEFT JOIN `like` l2
			ON l.id_user_from = l2.id_user_to
			LEFT JOIN user u
			ON u.id = l.id_user_from
			WHERE l.id_user_to = :id_user
			AND l2.id_user_from = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$history = $stm->execute();
		$history = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($history);
	}

}
