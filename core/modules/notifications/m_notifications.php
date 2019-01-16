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

			LEFT OUTER JOIN blocked b
			ON (b.id_user_from = :id_user
			AND b.id_user_to = u.id)

			WHERE bh.id_user_to = :id_user
			AND b.id_user_to IS NULL
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
			SELECT l.*, u.username, u.id,
			(CASE WHEN (l2.id_user_from IS NOT NULL AND l.timestamp > l2.timestamp) THEN 1 ELSE 0 END) AS `matche`
			FROM `like` l
			LEFT JOIN user u
			ON u.id = l.id_user_from
			LEFT JOIN `like` l2
			ON (l.id_user_to = l2.id_user_from
			AND l.id_user_from = l2.id_user_to
			AND l2.revoked = 0)

			LEFT OUTER JOIN blocked b
			ON (b.id_user_from = :id_user
			AND b.id_user_to = u.id)
			WHERE l.id_user_to = :id_user
			AND b.id_user_to IS NULL
			AND l.revoked = 0
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
			SELECT l.id_user_from, l.id_user_to, l.seen, l.revoked, u.username, u.id, l2.revoked, l2.timestamp
			FROM `like` l
			LEFT JOIN `like` l2
			ON l.id_user_from = l2.id_user_to
			LEFT JOIN user u
			ON u.id = l.id_user_from

			LEFT OUTER JOIN blocked b
			ON (b.id_user_from = :id_user
			AND b.id_user_to = u.id)
			WHERE l.id_user_to = :id_user
			AND b.id_user_to IS NULL
			AND l2.id_user_from = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$history = $stm->execute();
		$history = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($history);
	}

}
