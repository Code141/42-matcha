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

	public function insert(string $table, array $columns, array $values)
	{
		if ($count($columns) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'insert' in core/model.php");
		foreach ($columns as $column)
			$c = $column . ", ";
		$c = rtrim($c,", ");
		foreach ($values as $value)
			$v = $value . ", ";
		$v = rtrim($v,", ");
		$stm = "INSERT INTO " . $table . " (" . $c . ") VALUES (" . $v . ")";
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function update(string $table, array $columns, array $values)
	{
		if (($len = $count($columns)) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'update' in core/model.php");
		for($i = 0; $i < $len; $i++)
		{
			$u = $u . $columns[$i] . " = " . $values[$i] . ", ";
		}
		$u = rtrim($u,", ");
		$stm = "UPDATE " . $table . " SET " . $u;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function	select(array $columns, string $table)
	{
		$c = "";
		foreach ($columns as $column)
			$c = $c . $column . ", ";
		$c = rtrim($c,", ");
		$stm = "SELECT " . $c . " FROM " . $table;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function where(string $column, string $operator, string $value)
	{
		$stm = " WHERE " . $column . " " . $operator . " " . $value;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function and(string $column, string $operator, string $value)
	{
		$stm = " AND " . $column . " " . $operator . " " . $value;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function or(string $column, string $operator, string $value)
	{
		$stm = " OR " . $column . " " . $operator . " " . $value . "";
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function order_by(string $expression, string $direction)
	{
		if ($expression)
			$stm = " ORDER BY " . $expression . " " . $direction;
		$this->sql = $this->sql . $stm;
		return ($this);
	}
/*
	public function left_join(string table1, string table2, string column1, string column2)
	{
		$stm = " LEFT JOIN `" . $column . "` " . $operator . " '" . $value . "'";
		$this->sql = $this->sql . $stm;
		return ($this);

	}
 */
}

