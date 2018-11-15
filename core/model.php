<?php

class m_model
{
	public	$pdo;
	public	$sql;
	public	$bind_param = array();

	public function create_db()
	{
		require(CONFIG_PATH . 'database.php');
		$this->pdo = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
		$this->sql = "CREATE DATABASE IF NOT EXISTS " . APP_NAME     . ";\n USE `".APP_NAME."`";
		return ($this);
	}

	public function drop_db()
	{
		$this->sql = "DROP DATABASE IF EXISTS " . APP_NAME;
		return ($this);
	}

	public function from_file_to_query($file)
	{
		if (is_readable($file))
			$script = file($file);
		$query = '';
		foreach ($script as $line) {
			if(substr($line, 0, 2) == '--' || $line == '')
				continue ;
			$query .= $line;
		}
		$this->sql = $query;
		return($this);
	}
	
	public function bind_param()
	{
		$this->bind_param = array_unique($this->bind_param);
		foreach ($this->bind_param as $key => $value)
			$this->pdo_stm->bindParam($key , $value);
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

	public function where(string table, string $column, string $operator, string $value)
	{
		$stm = " WHERE " . $table . "." . $column . " " . $operator . " :" . $value;
		$this->sql = $this->sql . $stm;
		$this->bind_param[":" . $value] = $value;
		return ($this);
	}

	public function and(string table, string $column, string $operator, string $value)
	{
		$stm = " AND " . $table . "." . $column . " " . $operator . " :" . $value;
		$this->sql = $this->sql . $stm;
		$this->bind_param[":" . $value] = $value;
		return ($this);
	}

	public function or(string table, string $column, string $operator, string $value)
	{
		$stm = " OR " . $table . "." . $column . " " . $operator . " :" . $value . "";
		$this->sql = $this->sql . $stm;
		$this->bind_param[":" . $value] = $value;
		return ($this);
	}

	public function order_by(string $expression, string $direction)
	{
		if ($expression)
			$stm = " ORDER BY " . $expression . " " . $direction;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function join(string join_type, string table1, string table2, string column1, string column2)
	{
		$stm = " " . $join_type ." JOIN " . $table2 . " ON " . $table1 . "." . $column1 . " = " . $table2 . "." . $column2;
		$this->sql = $this->sql . $stm;
		return ($this);
	}
}
