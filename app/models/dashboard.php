<?php

class m_dashboard
{

	public function get_blocked($id_user)
	{
		$sql = "
			SELECT u.id, u.username
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
}
