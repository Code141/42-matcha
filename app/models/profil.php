
<?php
class m_profil extends m_wrapper
{
	public function create_profil($id_profil, $id_user_logged)
	{
		$profil = $this->fetch_user($id_profil, $id_user_logged);
		$profil['tags'] = $this->fetch_user_tags($id_profil);
		$profil['orientations'] = $this->fetch_orientations($id_profil);
		return ($profil);
	}

	private function fetch_user($id_profil, $id_user_logged)
	{
		$sql = "
			SELECT u.*, g.gender_name, gi.gender_identity_name 
			FROM user u
			LEFT JOIN gender g
			ON u.id_gender = g.id
			LEFT JOIN gender_identity gi
			ON u.id_gender_identity = gi.id
			LEFT JOIN blocked b
			ON b.`id_user(to)` = u.id
			WHERE u.id = :0
			AND (b.`id_user(to)` IS NULL OR
		   	NOT b.`id_user(from)` = :1 )
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
