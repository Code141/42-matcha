<?php

class m_interactions
{
	public function see_notifs($id_user)
	{
		$sql = "
			UPDATE `like`
			SET seen = '1'
			WHERE id_user_to = :id_user;

			UPDATE `browsing_history`
			SET seen = '1'
			WHERE id_user_to = :id_user;
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$stm->execute();
		return ($stm->rowCount());
	}

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
		$stm->execute();

		if ($stm->rowCount() == 0)
		{
			$sql = "
				UPDATE `like`
				SET `revoked` = 0, timestamp = now()
				WHERE id_user_from = :id_user_from
				AND id_user_to = :id_user_to
			";
			$stm = $this->db->pdo->prepare($sql);
			$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
			$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
			$stm->execute();
		}
		$sql = "
			UPDATE user 
			SET score = score + 1
			WHERE id = :id_user
		";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
	}

	public function dislike($id_user_from, $id_user_to)
	{
		$sql = "
			UPDATE `like`
			SET `revoked` = 1, timestamp = now()
			WHERE id_user_from = :id_user_from
			AND id_user_to = :id_user_to
			AND revoked = 0
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$stm->execute();

		if ($stm->rowCount())
		{
			$sql = "
				UPDATE user 
				SET score = score - 1
				WHERE id = :id_user
			";
			$stm = $this->db->pdo->prepare($sql);
			$stm->bindparam("id_user", $id_user_to, PDO::PARAM_INT);
			$stm->execute();
		}
		return ($stm->rowCount());
	}

	public function block($id_user_from, $id_user_to)
	{
		$sql = "
			SELECT id_user_from, id_user_to
			FROM blocked
			WHERE id_user_from = :id_user_from
			AND id_user_to = :id_user_to
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
		if (!$stm->rowCount())
		{
			$sql = "
				INSERT INTO blocked (id_user_from, id_user_to)
				VALUES(:id_user_from, :id_user_to)
				";
			$stm = $this->db->pdo->prepare($sql);
			$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
			$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
			$stm->execute();
		$sql = "
			UPDATE user 
			SET score = score - 5
			WHERE id = :id_user
		";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
	
			return (1);
		}
		return (0);
	}

	public function unblock($id_user_from, $id_user_to)
	{
		$sql = "
			DELETE FROM blocked
			WHERE id_user_from = :id_user_from AND id_user_to = :id_user_to
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
		if ($stm->rowCount())
		{
		$sql = "
			UPDATE user 
			SET score = score + 5
			WHERE id = :id_user
		";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
		}
	
	}

	public function report($id_user_from, $id_user_to)
	{
		$sql = "
			SELECT id_user_from, id_user_to
			FROM reported
			WHERE id_user_from = :id_user_from
			AND id_user_to = :id_user_to
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
		if (!$stm->rowCount())
		{
			$sql = "
				INSERT INTO reported (id_user_from, id_user_to)
				VALUES(:id_user_from, :id_user_to)
				";
			$stm = $this->db->pdo->prepare($sql);
			$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
			$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
			$stm->execute();

		$sql = "
			UPDATE user 
			SET score = score - 10
			WHERE id = :id_user
		";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user", $id_user_to, PDO::PARAM_INT);
		$stm->execute();
	
		}
	}


	public function does_match($id_user_from, $id_user_to)
	{
		$sql = "
			SELECT l.*, u.username, u.id,
			(CASE WHEN (l2.id_user_from IS NOT NULL AND l.timestamp > l2.timestamp) THEN 1 ELSE 0 END) AS `matche`
			FROM `like` l
			LEFT JOIN user u
			ON u.id = l.id_user_from
			LEFT JOIN `like` l2
			ON (l.id_user_to = l2.id_user_from
			AND l.id_user_from = l2.id_user_to
			AND l2.revoked = 0)
			WHERE l.id_user_to = :id_user_to
			AND l.id_user_from = :id_user_from
			AND l.revoked = 0
			AND l2.revoked = 0
			";
		$stm = $this->db->pdo->prepare($sql);
		$stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$toto = $stm->execute();
		return ($stm->rowCount());
	}

}
