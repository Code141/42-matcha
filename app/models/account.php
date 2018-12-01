<?php
class m_account
{
	public function fetch_all_from($table)
	{
		$sql = "
			SELECT *
			FROM " . $table;

		$stm = $this->db->pdo->prepare($sql);
		$selection = $stm->execute();
		$selection = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($selection);
	}
}
