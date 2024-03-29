<?php

class m_wrapper
{
	public $bind_param = array();
	public $stm;
	public	$sql;

	public function make_query()
	{
		$query[] = "SELECT " . implode(", ", $this->select);
		$query[] = "FROM " . implode (", ", $this->from);
		if (isset($this->join))
			$query[] = implode(" ", $this->join);
		if (isset($this->condition))
			$query[] = "WHERE (" . implode (") AND (", $this->condition) . " )";
		if (isset($this->group_by))
			$query[] = "GROUP BY " . implode(", ", $this->group_by);
		if (isset($this->having))
			$query[] = "HAVING " . implode(", ", $this->having);
		if (isset($this->order))
			$query[] = "ORDER BY " . implode(", ", $this->order);
		if (isset($this->limit))
			$query[] = $this->limit;
		$this->sql = implode(" ", $query) . ";";
//		echo $this->sql . "<br><br><br>";
//		var_dump($this->bind_param);
//		echo "<br><br><br>";
		return ($this);
	}

	public function fetchAll()
	{
		$returned_data = $this->stm->fetchAll(PDO::FETCH_ASSOC);
		return($returned_data);
	}

	public function rowCount()
	{
		$returned_data = $this->stm->rowCount();
		return($returned_data);
	}

	public function execute()
	{
		$this->make_query();
		$this->prepare();
		$this->bind_params();
		try
		{
			$this->stm->execute();
		}
		catch (PDOException $exception)
		{
			exit("Something went wrong : " . $exception->getMessage());
		}

		if (!empty($stm->pdo_stm))
			$this->stm->closeCursor();
	
		return ($this);
	}
	
	public function prepare()
	{
		$this->stm = $this->db->pdo->prepare($this->sql);
		return ($this);
	}

	public function bind_params()
	{
		foreach ($this->bind_param as $key => &$value)
			$this->stm->bindParam(":" . $key, $value);
		return ($this);
	}

	public function limit($start, $end)
	{
		$this->limit = "LIMIT " . $start . " , " . $end;
		return ($this);
	}

	public function all_tags()
	{
		$this->select[] = "*";
		$this->from[] = "tag";
		return ($this);
	}
}
