<?php

function	db_existe($db)
{
	try
	{
		$pdo = new PDO($db['dsn'], $db['user'], $db['password']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(PDOException $exception)
	{
		if ($exception->getCode() == 1049)
			return (FALSE);
		else
			die('Erreur : ' . $exception->getMessage());
	}
	return (TRUE);
}

function	create_db($db)
{
	try
	{
		$pdo = new PDO($db['dsn_setup'], $db['user'], $db['password']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$pdo->exec("CREATE DATABASE " . $db['name']);
		return "TRUE";
	}
	catch(PDOException $exception)
	{
		echo 'Erreur : ' . $exception->getMessage();
		die ();
	}
}

function delete_all($db)
{
	try
	{
		$pdo = new PDO($db['dsn'], $db['user'], $db['password']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$pdo->exec("DROP DATABASE IF EXISTS " . $db['name']);
	}
	catch(PDOException $exception)
	{
		echo 'Erreur : ' . $exception->getMessage();
		die ();
	}
}

function execute_file($db, $file)
{
	try
	{
		$pdo = new PDO($db['dsn'], $db['user'], $db['password']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(PDOException $exception)
	{
		echo 'Erreur : ' . $exception->getMessage();
		die ();
	}
	if (!is_readable($file))
		die ("Can't read " . $file);
	$sql_content = file_get_contents($file);
	try
	{
		$pdo->exec($sql_content);
	}
	catch(PDOException $exception)
	{
		echo 'Erreur : ' . $exception->getMessage();
		die ();
	}
}

function	delete_png($folder)
{
	if (!is_dir($folder))
		return;
	$files = scandir($folder);
	$files = preg_grep("/^([0-9]+.png)$/", $files);
	foreach ($files as $file)
		unlink($folder . $file);
}

function	copy_png($src, $dest)
{
	if (!is_dir($dest))
		mkdir($dest);
	$files = scandir($src);
	$files = preg_grep("/^([0-9]+.png)$/", $files);
	foreach ($files as $file)
		copy($src . $file, $dest . $file);
}
