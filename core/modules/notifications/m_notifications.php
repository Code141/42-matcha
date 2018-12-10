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
}
