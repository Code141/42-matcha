<?php
class m_admin 
{
	public function fetch_blocked_users()
	{
		$sql = 
			"SELECT u.username, u.id , COUNT(b.id_user_from) as times_blocked 
			FROM `blocked` b
			LEFT OUTER JOIN `user` u
			ON b.id_user_to = u.id
			GROUP BY (b.id_user_to)
			ORDER BY times_blocked DESC";
		$stm = $this->db->pdo->prepare($sql);
		$selection = $stm->execute();
		$selection = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($selection);
	}

	public function fetch_reported_users()
	{
		$sql = 
			"SELECT u.username, u.id , COUNT(r.id_user_from) as times_reported 
			FROM `reported` r
			LEFT OUTER JOIN `user` u
			ON r.id_user_to = u.id
			GROUP BY (r.id_user_to)
			ORDER BY times_reported DESC";
		$stm = $this->db->pdo->prepare($sql);
		$selection = $stm->execute();
		$selection = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($selection);
	}

	public function fetch_user_media($id_user)
	{
		$sql = "SELECT id_media
				FROM media
				WHERE id_user = :id_user";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":id_user", $id_user);
		$selection = $stm->execute();
		$selection = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($selection);
	}

	public function delete_user($id_user)
	{
		$sql = 
			"DELETE u, bio, blocked, bh, c, conv, `like`, media, msg, r, uo, ut
			FROM user u
			LEFT OUTER JOIN bio
			ON bio.id_user = u.id 
			LEFT OUTER JOIN blocked
			ON blocked.id_user_to = u.id OR blocked.id_user_from = u.id
			LEFT OUTER JOIN browsing_history bh 
			ON bh.id_user_to = u.id OR bh.id_user_from = u.id
			LEFT OUTER JOIN connexion c 
			ON c.id_user = u.id 
			LEFT OUTER JOIN conv 
			ON conv.id_user_to = u.id OR conv.id_user_from = u.id
			LEFT OUTER JOIN `like`
			ON `like`.id_user_to = u.id OR `like`.id_user_from = u.id
			LEFT OUTER JOIN media
			ON media.id_user = u.id
			LEFT OUTER JOIN msg
			ON msg.id_user_to = u.id OR msg.id_user_from = u.id
			LEFT OUTER JOIN reported r
			ON r.id_user_to = u.id OR r.id_user_from = u.id
			LEFT OUTER JOIN user_orientation uo
			ON uo.id_user = u.id
			LEFT OUTER JOIN user_tags ut
			ON ut.id_user = u.id
			WHERE u.id = :id_user";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam(":id_user", $id_user);
		$stm->execute();	
		return ($stm->rowCount());	
	}
}
