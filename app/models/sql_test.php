<?php

class m_sql_test extends m_wrapper
{
	public $sql;

	public function test()
	{
		$this->select(array("user" => "username"),"user")->where("user","id", "=" , "1");
		$this->db->sql = $this->sql; 
		$this->data['sql'] = $this->db->sql;
		var_dump($this->data['sql']);
		echo "<br>";
		$result = $this->db->execute_pdo()->fetch(PDO::FETCH_ASSOC);
		return ($result);
	}
	public function matches()
	{
		$this
			->select(array("user" => "username"),"user")
			->join("LEFT", "user_orientation", "user", "user_id", "id")
			->join("LEFT", "user_gender", "user", "user_id", "id")
			->join("LEFT", "user_gender_identity", "user", "user_id", "id")
			->where("user_orientation", "id_gender", "=" , "1")
			->and("user_orientation", "id_gender_identity", "=" , "1")
			->and("user","id", "=" , "1");
			;
		$this->db->sql = $this->sql; 
		$this->data['sql'] = $this->db->sql;
		var_dump($this->data['sql']);
		echo "<br>";
		var_dump($this->db->bind_param);
		$result = $this->db->execute_pdo()->fetch(PDO::FETCH_ASSOC);
		return ($result);
	}
}
