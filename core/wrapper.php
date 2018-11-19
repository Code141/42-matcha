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
		$query[] = "JOIN " . implode(" JOIN ", $this->join);
		$query[] = "WHERE (" . implode (") AND (", $this->condition) . " )";
		$query[] = "ORDER BY " . implode(", ", $this->order);
		var_dump($query);
		$this->sql = implode(" ", $query) . ";";
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
		echo "<br> bind params = ";
		var_dump($this->bind_param);
		echo "<br>";
		foreach ($this->bind_param as $key => $value)
			$this->stm->bindParam(":" . $key, $value);

 		echo  "<br>-------BINDED STMT-------------<br>";		

		$this->stm->debugDumpParams();
		return ($this);
	}

	public function insert(string $table, array $columns, array $values)
	{
		if ($count($columns) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'insert' in core/model.php");
		$c = implode(", ", $columns);
		$v = ":" . implode(", :", $values);
		$stm = "INSERT INTO " . $table . " (" . $c . ") VALUES (" . $v . ")";
		$this->sql = $this->sql . $stm;
		foreach ($values as $value)
			$this->bind_param[":".$value] = $value;
		return ($this);
	}

	public function update(string $table, array $columns, array $values)
	{
		if (($len = $count($columns)) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'update' in core/model.php");
		for($i = 0; $i < $len; $i++)
		{
			$u .= $columns[$i] . " = :" . $values[$i] . ", ";
			$this->bind_param[":" . $values[$i]] = $values[$i];
		}
		$u = rtrim($u,", ");
		$stm = "UPDATE " . $table . " SET " . $u;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function	select(array $t_c)
	{
		$c = "";
		foreach ($t_c as $table => $column)
			$c .= $table . "." . $column . ", ";
		$c = rtrim($c, ", ");
		$stm = "SELECT " . $c . " FROM " . key($t_c);
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function where(string $table, string $column, string $operator, string $value)
	{
		//$to_bind = preg_replace("/\./", "_", $value);
	//	$stm = " WHERE " . $table . "." . $column . " " . $operator . " :" . $to_bind;
		$stm = " WHERE " . $table . "." . $column . " " . $operator . " :" . $value;
		$this->sql = $this->sql . $stm;
		//$this->bind_param[":" . $to_bind] = $value;
		$this->bind_param[":" . $value] = $value;
		return ($this);
	}

	public function and(string $table, string $column, string $operator, string $value)
	{
		$stm = " AND " . $table . "." . $column . " " . $operator . " :" . $value;
		$this->sql = $this->sql . $stm;
		$this->db->bind_param[":" . $value] = $value;
		return ($this);
	}

	public function or(string $table, string $column, string $operator, string $value)
	{
		$stm = " OR " . $table . "." . $column . " " . $operator . " :" . $value . "";
		$this->sql = $this->sql . $stm;
		$this->db->bind_param[":" . $value] = $value;
		return ($this);
	}

	public function order_by(string $expression, string $direction)
	{
		if ($expression)
			$stm = " ORDER BY " . $expression . " " . $direction;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function join(string $join_type, string $table1, string $table2, string $column1, string $column2)
	{
		$stm = $join_type ." JOIN " . $table2 . " ON " . $table1 . "." . $column1 . " = " . $table2 . "." . $column2;
		$this->sql = $this->sql . $stm;
		return ($this);
	}
}
