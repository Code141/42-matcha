<?php

class m_interactions
{
	public function like($id_user_from, $id_user_to)
	{
		$sql = "
			INSERT IGNORE INTO `like`
			(id_user_from, id_user_to)
			VALUES
			(:id_user_from, :id_user_to)
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
		return (NULL);
	
	}
}
