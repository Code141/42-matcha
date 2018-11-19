<?php

class	db
{
	public	$pdo;

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

	}

	public function	__destruct()
	{
		if (!empty($this->pdo_stm))
			$this->pdo_stm->closeCursor();
		$this->pdo_stm = NULL;
		$this->pdo = NULL;
	}
}

