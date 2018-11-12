<?php
require_once('config.php');
require_once('database.php');
require_once('setup/db.php');

if (DEV_MODE == FALSE)
{
	header("Location: " . SITE_ROOT);
	die ();
}

$db['name'] = $DB_NAME;
$db['dsn'] = $DB_DSN;
$db['dsn_setup'] = $DB_DSN_SETUP;
$db['user'] = $DB_USER;
$db['password'] = $DB_PASSWORD;

$data['db_existe'] = db_existe($db);


$sample = SERVER_ROOT . "sample/user_media/";
$media = SERVER_ROOT . "app/assets/media/user_media/";

if (isset($_GET['action']))
{
	if ($_GET['action'] == "reset_db")
	{
		if ($data['db_existe'] == TRUE)
		{
			delete_all($db);
			$data['msg'] = "Database deleted !";
			$data['db_existe'] = FALSE;
			delete_png($media);
			delete_png($media . "thumbs/");
		}
	}
	if ($_GET['action'] == "create_db")
	{
		if ($data['db_existe'] == FALSE)
		{
			create_db($db);
			execute_file($db, 'sql/tables.sql');
			$data['msg'] = "Database created !";
			$data['db_existe'] = TRUE;
		}
	}
	if ($_GET['action'] == "put_sample")
	{
		if ($data['db_existe'] == FALSE)
		{
			create_db($db);
			execute_file($db, 'sql/tables.sql');
			execute_file($db, '../sample/sample.sql');
			copy_png($sample, $media);
			copy_png($sample . "thumbs/", $media . "thumbs/");
			$data['db_existe'] = TRUE;
			$data['msg'] = "Sample generated";
		}
	}
}

include("./setup/status.html");
if (isset($data['db_existe']))
	include("./setup/main.html");

