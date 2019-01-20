<?php

class	db
{
	public	$pdo;

	public function	set_up_connect()
	{
		require(CONFIG_PATH . 'database.php');
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
				die();
			}
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
			if ($exception->getcode() == 1049)
			{
				$this->pdo = new pdo("mysql:host=localhost", $db_user, $db_password);

				if (DEV_MODE)
					$this->core->set_view("setup", "main");
				else
					die("please set dev_mode to true in your config/config.php to install db");
			}
			if ($exception->getcode() == 1045)
				die("bad bdd password, please see config/database.php");
			else
				if (DEV_MODE)
					die('Erreur : ' . $exception->getMessage());
			die("An unknown error occured, please try again later");
		}
}

public function	execute_pdo($pdo_stm, $page, $action)
{
	try
	{
		$pdo_stm->execute();
	}
	catch (PDOException $e)
	{
		if (DEV_MODE)
			die($e->getMessage());
		else
			$this->core->fail('An error has occured', $page, $action);
	}
	return ($pdo_stm);
}

public function	execute()
{
	try
	{
		$pdo_stm->execute();
	}
	catch (PDOException $e)
	{
		$this->core->fail($e->getMessage(), $page, $action);
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
