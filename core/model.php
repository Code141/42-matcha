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

	public function	select(array $columns, string $table)
	{
		$c = "";
		foreach ($columns as $column)
			$c = $c."`".$column."`, ";
		$c = rtrim($c,", ");

		$stm = "SELECT " . $c . " FROM `" . $table . "`";
 
		$this->sql = $this->sql . $stm;

		return ($this);
	}
	
	public function where(array $columns, array $values)
	{
		if (count($columns) != count($values))
		   exit("ERROR in \"where\" function : arrays are not the same size !");	
		
		$c = "";
		for ($i = 0; $i < count($columns); $i++){
			$c = $c . "`" . $columns[$i] . "` = " . $values[$i] . " AND ";
		}
		$c = rtrim($c," AND ");
		
		$stm = " WHERE " . $c;

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

