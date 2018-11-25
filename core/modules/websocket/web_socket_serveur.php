<?php

set_time_limit (0);

define('HOST_NAME',"localhost"); 
define('PORT',"8090");

$null = NULL;
require_once("class.chathandler.php");

class socket_server
{
	public function	__construct()
	{
		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
		socket_bind($this->socket, 0, PORT);
		socket_listen($this->socket);
		$this->clientSocketArray = array($this->socket);
	}

	public function work()
	{
		$newSocketArray = $this->clientSocketArray;					// duplique une copie de traveil
		socket_select($newSocketArray, $null, $null, 0, 10);		// FILTRE LES SOCKECT MODIFIE

		if (in_array($this->socket, $newSocketArray)) // Si un des socket a ete modifie
		{
			$newSocket = socket_accept($this->socket);
			$this->clientSocketArray[] = $newSocket;

			$header = socket_read($newSocket, 1024);
			$this->chat->doHandshake($header, $newSocket, HOST_NAME, PORT);

			socket_getpeername($newSocket, $client_ip_address);
			$connectionACK = $this->chat->newConnectionACK($client_ip_address);
			$this->chat->broadcast($this->clientSocketArray, $connectionACK);

			$newSocketIndex = array_search($this->socket, $newSocketArray);
			unset($newSocketArray[$newSocketIndex]);
		}

		foreach ($newSocketArray as $newSocketArrayResource)
		{
			while(socket_recv($newSocketArrayResource, $socketData, 1024, 0) > 0)
			{

				$socketMessage = $this->chat->unseal($socketData);
				$messageObj = json_decode($socketMessage);

				if (!empty($messageObj->ssid))
				{
					$ssid = $messageObj->ssid;
					session_id($ssid);
					session_start();
					$id_user = $_SESSION['user']['id'];
					$username = $_SESSION['user']['username'];
					session_write_close();
//					$this->clientSocketArray[$id_user] = $newSocket;
				}

				if (!empty($messageObj) && !empty($messageObj->chat_user) && !empty($messageObj->chat_message))
				{
					$chat_box_message = $this->chat->createChatBoxMessage($username, $messageObj->chat_message);
					$this->chat->broadcast($this->clientSocketArray, $chat_box_message);
				}
				break 2;
			}

			$socketData = socket_read($newSocketArrayResource, 1024, PHP_NORMAL_READ);

			if ($socketData === false) { 
				socket_getpeername($newSocketArrayResource, $client_ip_address);
				$connectionACK = $this->chat->connectionDisconnectACK($client_ip_address);
				$this->chat->broadcast($this->clientSocketArray, $connectionACK);
				$newSocketIndex = array_search($newSocketArrayResource, $this->clientSocketArray);
				unset($this->clientSocketArray[$newSocketIndex]);			
			}
		}
	}

	public function __destruct()
	{
		socket_close($this->socket);
	}
}

$server = new socket_server();
$server->chat = new ChatHandler();
while (true)
	$server->work();
