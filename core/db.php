<?php

class	db
{
	public	$pdo;
	public	$sql;
	public	$bind_param = array();

	public function	connect()
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
				{
					$this->pdo = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
					$this->core->fail("Database doesn't existe", "setup", "main");
				}
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

		$this->bind_param = array_unique($this->bind_param);
		foreach ($this->bind_param as $key => $value)
			$this->pdo_stm->bindParam($key, $value);
		
		try
		{
			$this->pdo_stm->execute();
		}
		catch (PDOException $exception)
		{
			exit("Something went wrong : " . $exception->getMessage());
		}

		return ($this->pdo_stm);
	}

	public function	__destruct()
	{
		if (!empty($this->pdo_stm))
			$this->pdo_stm->closeCursor();
		$this->pdo_stm = NULL;
		$this->pdo = NULL;
	}
}

