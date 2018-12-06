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

	public function update_user($id_user, $fields)
	{
		$set = "";
		foreach ($fields as $column => $value)
		{
			$set .= $column . " = :" . $column . " , ";
		}
		$set = rtrim($set," , ");
		$sql = "
			UPDATE user
			SET " . $set . 
			" WHERE id = :id_user";

		echo '<br>'.$sql.'<br>';
		$stm = $this->db->pdo->prepare($sql);
		foreach ($fields as $column => &$value)
		{
			$stm->bindparam(":" . $column, $value);
		}
		$stm->bindparam("id_user", $id_user, PDO::PARAM_INT);
		$update = $stm->execute();
		$update = $stm->rowCount();
		return ($update);
	}
}
