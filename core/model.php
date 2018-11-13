<?php

class m_model
{
	public	$pdo;
	public	$sql;

	public function	__construct()
	{
		/*
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
		 */
	}

	public function	execute_pdo()
	{
		$this->pdo_stm->execute();
		return ($this->pdo_stm);
	}

	public function	select(string $table,array $columns)
	{
		$c = "";
		foreach ($columns as $column)
			$c = $c."`".$column."`, ";
		$c = rtrim($c,", ");

		$stmt = "SELECT ".$c." FROM `".$table."`";
 
		$this->sql = $stmt;

		return ($this);
	}
	
	public function where(array $columns, array $values)
	{

	}

	public function	__destruct()
	{
		if (!empty($this->pdo_stm))
			$this->pdo_stm->closeCursor();
		$this->pdo_stm = NULL;
		$this->pdo = NULL;
	}
}

