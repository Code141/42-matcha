<?php

class m_message
{
	public function get_message($id_user)
	{
		$sql = "
			SELECT *
			FROM user
			WHERE id = :id_user
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_STR);
		$user = $stm->execute();
		$user = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($user) == 1)
			return ($user[0]);
		return (NULL);
	}
}
