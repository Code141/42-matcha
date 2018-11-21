<?php


class m_module_session
{
	public function get_user_by_login($username)
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
