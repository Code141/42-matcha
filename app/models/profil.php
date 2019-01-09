<?php

class m_profil
{
	public function create_profil($id_profil, $id_user_logged)
	{
		$profil = $this->fetch_user($id_profil, $id_user_logged);
		if ($profil == NULL)
			return (NULL);
		$profil['tags'] = $this->fetch_user_tags($id_profil);
		$profil['orientations'] = $this->fetch_orientations($id_profil);
		$profil['like'] = $this->like($id_profil, $id_user_logged);
		return ($profil);
	}

	private function fetch_user($id_profil, $id_user_logged)
	{
		$sql = "
			SELECT u.*, g.gender_name, gi.gender_identity_name, bio.bio
			FROM user u
			LEFT JOIN gender g
			ON u.id_gender = g.id
			LEFT JOIN gender_identity gi
			ON u.id_gender_identity = gi.id
			LEFT JOIN blocked b
			ON b.`id_user_to` = u.id
			LEFT JOIN bio
			ON bio.`id_user` = u.id
			WHERE u.id = :0
			AND (b.`id_user_to` IS NULL OR
			NOT b.`id_user_from` = :1 )
		";

		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":0", $id_profil, PDO::PARAM_STR);
		$stm->bindparam(":1", $id_user_logged, PDO::PARAM_STR);
		$user = $stm->execute();
		$user = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($user) == 1)
			return ($user[0]);
		return (NULL);
	}

	private function like($id_profil, $id_user_logged)
	{
		$sql = "
			SELECT
				(CASE WHEN l1.id_user_from = :0 THEN l1.id_user_from ELSE l2.id_user_from END) AS u1,
				(CASE WHEN l1.id_user_from = :0 THEN l2.id_user_from ELSE l1.id_user_from END) AS u2,
				(CASE WHEN l1.id_user_from = :0 THEN l1.revoked ELSE l2.revoked END) AS u1_revoked,
				(CASE WHEN l1.id_user_from = :0 THEN l2.revoked ELSE l1.revoked END) AS u2_revoked,
				(CASE WHEN l1.id_user_from = :0 THEN l1.timestamp ELSE l2.timestamp END) AS u1_date,
				(CASE WHEN l1.id_user_from = :0 THEN l2.timestamp ELSE l1.timestamp END) AS u2_date
			FROM `like` l1
			LEFT JOIN `like` l2
				ON ((l1.id_user_from = l2.id_user_to)
				AND
				(l2.id_user_from = l1.id_user_to))
			WHERE ((l1.id_user_from = :0 AND l1.id_user_to = :1)
				OR
				(l1.id_user_from = :1 AND l1.id_user_to = :0))
			LIMIT 1
		";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":0", $id_user_logged, PDO::PARAM_STR);
		$stm->bindparam(":1", $id_profil, PDO::PARAM_STR);
		$user = $stm->execute();
		$user = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($user) == 1)
			return ($user[0]);
		return (NULL);
	}


	private function fetch_user_tags($id_profil)
	{
		$sql = "
			SELECT t.id, t.tag_name
			FROM tag t
			LEFT JOIN user_tags ut
			ON ut.id_tag = t.id
			WHERE ut.id_user = :0
		";

		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":0", $id_profil, PDO::PARAM_STR);
		$tags = $stm->execute();
		$tags = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($tags);
	}

	private function fetch_orientations($id_profil)
	{
		$sql = "
			SELECT g.id, g.gender_name, gi.id, gi.gender_identity_name
			FROM user_orientation uo
			LEFT JOIN gender g
			ON g.id = uo.id_gender
			LEFT JOIN gender_identity gi
			ON gi.id = uo.id_gender_identity
			WHERE uo.id_user = :0";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":0", $id_profil, PDO::PARAM_STR);
		$orientations = $stm->execute();
		$orientations = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($orientations);
	}
}
