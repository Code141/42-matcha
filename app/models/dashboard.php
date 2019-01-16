<?php

class m_dashboard
{
	public function get_blocked($id_user)
	{
		$sql = "
			SELECT u.id, u.username, u.id_media
			FROM `blocked` b
			LEFT JOIN user u
			ON u.id = b.id_user_to
			WHERE b.id_user_from = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$history = $stm->execute();
		$history = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($history);
	}
	
	public function get_matched($id_user)
	{
		$sql = "
			SELECT DISTINCT u.id, u.username, u.id_media, c.timestamp as last_connexion
			FROM `like` l1
			LEFT JOIN `like` l2
			ON l1.id_user_to = l2.id_user_from
			LEFT JOIN user u
			ON l2.id_user_from = u.id
			LEFT OUTER JOIN blocked b
			ON (b.id_user_from = :id_user
			AND b.id_user_to = u.id)

			LEFT JOIN connexion c
			ON c.id_user = u.id

			WHERE (l1.id_user_from = :id_user
			AND l2.id_user_to = :id_user)
			AND (l1.revoked = 0
				AND l2.revoked = 0
			)
			AND b.id_user_to IS NULL";

		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$matches = $stm->execute();
		$matches = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($matches);
	}
	
	public function liked_by($id_user)
	{
		$sql = "
			SELECT DISTINCT u.id, u.username, u.id_media
			FROM user u
			LEFT JOIN `like` l1
			ON l1.id_user_from = u.id
			LEFT OUTER JOIN `like` l2
			ON (l1.id_user_to = l2.id_user_from
				AND l1.id_user_from = l2.id_user_to)
			LEFT OUTER JOIN blocked b
			ON (b.id_user_from = :id_user
			AND b.id_user_to = u.id)
			WHERE l1.id_user_to = :id_user
			AND l1.revoked = 0
			AND (l2.id_user_from IS NULL OR l2.revoked = 1)
			AND b.id_user_from IS NULL
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$matches = $stm->execute();
		$matches = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($matches);
	}

	public function liked($id_user)
	{
		$sql = "
			SELECT DISTINCT u.id, u.username, u.id_media
			FROM user u
            LEFT JOIN `like` l1
			ON l1.id_user_to = u.id
			LEFT OUTER JOIN `like` l2
			ON (l1.id_user_to = l2.id_user_from
			AND l1.id_user_from = l2.id_user_to)
			LEFT OUTER JOIN blocked b
			ON (b.id_user_from = :id_user
			AND b.id_user_to = u.id)
			WHERE l1.id_user_from = :id_user
			AND l1.revoked = 0
			AND (l2.id_user_from IS NULL OR l2.revoked = 1)
			AND b.id_user_from IS NULL";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$matches = $stm->execute();
		$matches = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($matches);
	}
}
