<?php

class	db
{
	public	$pdo;

	public function	set_up_connect()
	{
		require(CONFIG_PATH . 'database.php');
		echo $DB_USER;
		try
		{
			$this->pdo = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
			if (DEV_MODE)
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(PDOException $exception)
		{
			if (DEV_MODE)
			{
				echo 'Erreur : ' . $exception->getMessage();
			}
			else
				header ('location:' . SITE_ROOT . '404');
		}
	}

	public function	connect_base()
	{
		require(CONFIG_PATH . 'database.php');
		try
		{
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
					$this->core->set_view("setup", "main");
				}

				if ($exception->getCode() == 1045)
				{
					echo "BAD BDD PASSWORD, PLEASE SEE config/database.php";
					$this->core->set_view("setup", "main");
				}
	
				else
					echo 'Erreur : ' . $exception->getMessage();
			}
			else
				header ('location:' . SITE_ROOT . '404');
		}
	}

	public function	execute_pdo()
	{
		$pdo_stm = $this->pdo->prepare($this->sql);

		try
		{
			$pdo_stm->execute();
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
		return ($pdo_stm);
	}

	public function	__destruct()
	{
		if (!empty($this->pdo_stm))
			$this->pdo_stm->closeCursor();
		$this->pdo_stm = NULL;
		$this->pdo = NULL;
	}
}

