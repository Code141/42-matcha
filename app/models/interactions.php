<?php

class m_interactions
{
	public function like($id_user_from, $id_user_to)
	{
		$sql = "
			INSERT INTO `like` (id_user_from, id_user_to)
			SELECT DISTINCT u1.id, u2.id
			FROM user u1
			LEFT OUTER JOIN user u2
			ON u2.id = :id_user_to
			LEFT OUTER JOIN `like` l
			ON l.id_user_from = :id_user_from AND l.id_user_to = :id_user_to
			WHERE u1.id = :id_user_from
			AND l.id_user_from IS NULL
			AND l.id_user_to IS NULL
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		try
		{
			$stm->execute();
		}
		catch(PDOException $exception)
		{
			echo 'Erreur : ' . $exception->getMessage();
		}
		return ($stm->rowCount());
	}
}
