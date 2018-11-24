<?php


session_start();
$_SESSION['YOUHOUUU'] = "HEGIWUHFWIUEGFH";
echo session_id();
define('HOST_NAME',"localhost"); 
define('PORT',"8090");

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_connect($socket, HOST_NAME, PORT);

$msg = "intern" . $_POST['json'];
socket_write($socket, $msg, 1024);

