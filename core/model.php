<?php

class m_model
{
	public	$pdo;
	public	$sql;

	public function	__construct()
	{
		
		try
		{
			require(CONFIG_PATH . 'database.php');
			$this->pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			if (DEV_MODE)
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(PDOException $exception)
		{
			if (DEV_MODE)
			{
				if ($exception->getCode() == 1049)
					header ('location:' . SITE_ROOT . 'config/setup.php');
				else
					echo 'Erreur : ' . $exception->getMessage();
			}
			else
				header ('location:' . SITE_ROOT . '404');
			die();
		}
		 
	}
	
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

	public function	execute_pdo()
	{
		$this->pdo_stm = $this->pdo->prepare($this->sql);
		try {
			$this->pdo_stm->execute();
		} catch (PDOException $exception){
			exit("Something went wrong : " . $exception);//->getMessage());
		}

		return ($this->pdo_stm);
	}
	
	public function insert(string $table, array $columns, array $values)
	{
		if ($count($columns) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'insert' in core/model.php");
		foreach ($columns as $column)
			$c = "`" . $column . "`, ";
		$c = rtrim($c,", ");
		foreach ($values as $value)
			$v = "'" . $value . "', ";
		$v = rtrim($v,", ");
		$stm = "INSERT INTO `" . $table . "` (" . $c . ") VALUES (" . $v . ")";
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function update(string $table, array $columns, array $values)
	{
		if (($len = $count($columns)) != count($values))
			exit("ERROR : nb of columns don't match nb of values in function 'update' in core/model.php");
		for($i = 0; $i < $len; $i++)
		{
			$u = $u . "`" . $columns[$i] . "` = '" . $values[$i] . "', ";
		}
		$u = rtrim($u,", ");
		$stm = "UPDATE `" . $table . " SET " . $u;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function	select(array $columns, string $table)
	{
		$c = "";
		foreach ($columns as $column)
			$c = $c . "`" . $column . "`, ";
		$c = rtrim($c,", ");
		$stm = "SELECT " . $c . " FROM `" . $table . "`";
		$this->sql = $this->sql . $stm;
		return ($this);
	}
	
	public function where(string $column, string $operator, string $value)
	{
		$stm = " WHERE `" . $column . "` " . $operator . " '" . $value . "'";
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function and(string $column, string $operator, string $value)
	{
		$stm = " AND `" . $column . "` " . $operator . " '" . $value . "'";
		$this->sql = $this->sql . $stm;
		return ($this);
	}
	
	public function or(string $column, string $operator, string $value)
	{
		$stm = " OR `" . $column . "` " . $operator . " '" . $value . "'";
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function order_by(string $expression, string $direction)
	{
		if ($expression)
			$stm = " ORDER BY `" . $expression . "` " .$direction;
		$this->sql = $this->sql . $stm;
		return ($this);
	}

	public function	__destruct()
	{
		if (!empty($this->pdo_stm))
			$this->pdo_stm->closeCursor();
		$this->pdo_stm = NULL;
		$this->pdo = NULL;
	}
}

