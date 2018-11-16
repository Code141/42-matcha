<?php

class m_wrapper
{
//	public	$pdo;
	
	public function insert(string $table, array $columns, array $values)
	{
		if ($count($columns) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'insert' in core/model.php");
		$c = implode(", ", $columns);
		$v = ":" . implode(", :", $values);
		$stm = "INSERT INTO " . $table . " (" . $c . ") VALUES (" . $v . ")";
		$this->sql = $this->sql . $stm;
		foreach ($values as $value)
			$this->db->bind_param[":".$value] = $value;
		return ($this);
	}

	public function update(string $table, array $columns, array $values)
	{
		if (($len = $count($columns)) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'update' in core/model.php");
		for($i = 0; $i < $len; $i++)
		{
			$u .= $columns[$i] . " = :" . $values[$i] . ", ";
			$this->db->bind_param[":" . $values[$i]] = $values[$i];
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
		//$this->db->bind_param[":" . $to_bind] = $value;
		$this->db->bind_param[":" . $value] = $value;
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
		$stm = " " . $join_type ." JOIN " . $table2 . " ON " . $table1 . "." . $column1 . " = " . $table2 . "." . $column2;
		$this->sql = $this->sql . $stm;
		return ($this);
	}
}
