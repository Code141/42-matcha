<?php
echo shell_exec("pwd");

define('DEV_MODE', TRUE);

define('CORE_PATH', 'core/');
define('CONFIG_PATH', 'config/');

require_once(CORE_PATH . "db.php");

set_time_limit (0);
define('HOST_NAME',"localhost"); 
define('PORT',"8090");

$null = NULL;
require_once("class.chathandler.php");

class socket_server
{
	public function	__construct()
	{
		$this->db = new db();
		$this->db->connect_base();

		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
		socket_bind($this->socket, 0, PORT);
		socket_listen($this->socket);

		$this->clientSocketArray = array($this->socket);
		$this->working_sokets = array();
		$this->user = array();
	}

	public function loop_work()
	{
		$this->working_sokets = $this->clientSocketArray;			// DUPLIQUE UNE COPIE DE TRAVAIL
		socket_select($this->working_sokets, $null, $null, 0, 10);	// FILTRE LES SOCKECT MODIFIE

		if (in_array($this->socket, $this->working_sokets)) // Si un des socket a ete modifie
			$this->connect();

		foreach ($this->working_sokets as $current_socket)
			$this->incoming($current_socket);
	}

	public function connect()
	{
			$newSocket = socket_accept($this->socket);

			$this->clientSocketArray[] = $newSocket;
			$header = socket_read($newSocket, 1024);
			$this->chat->doHandshake($header, $newSocket, HOST_NAME, PORT);

			$newSocketIndex = array_search($this->socket, $this->working_sokets);
			unset($this->working_sokets[$newSocketIndex]);
	}

	public function incoming($current_socket)
	{
			while(socket_recv($current_socket, $socketData, 1024, 0) > 0)
			{
				$socketMessage = $this->chat->unseal($socketData);
				$messageObj = json_decode($socketMessage);

				if (!empty($messageObj->ssid))
				{
					$ssid = $messageObj->ssid;
					session_id($ssid);
					session_start();
					$user = $_SESSION['user'];
					$id_user = $_SESSION['user']['id'];
					$this->user[$id_user]['user'] = $_SESSION['user'];
					$this->user[$id_user]['socket'] = $current_socket;
				}

				if (!empty($messageObj->ssid))
				{
					$this->db->sql = "
						SELECT *
						FROM `like` l1
						LEFT JOIN `like` l2
						ON l1.id_user_to = l2.id_user_from
						WHERE l1.id_user_from = " . $user['id'] . "
						AND l2.id_user_to = " . $user['id'];
					$stm = $this->db->execute_pdo();
					$this->user[$id_user]['user'] = $_SESSION['user'];
//					var_dump ($stm->fetchAll());
					session_write_close();
//					$this->clientSocketArray[$id_user] = $newSocket;
				}

				if (!empty($messageObj) && !empty($messageObj->chat_message))
				{
					$chat_box_message = $this->chat->createChatBoxMessage($user['username'], $messageObj->chat_message);
					$this->chat->broadcast($this->clientSocketArray, $chat_box_message);
				}
				return ;
			}

			$socketData = socket_read($current_socket, 1024, PHP_NORMAL_READ);
			if ($socketData === false)
			{
/*
				socket_getpeername($current_socket, $client_ip_address);
				$connectionACK = $this->chat->connectionDisconnectACK($client_ip_address);
				$this->chat->broadcast($this->clientSocketArray, $connectionACK);
*/
				$newSocketIndex = array_search($current_socket, $this->clientSocketArray);
				unset($this->clientSocketArray[$newSocketIndex]);			
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
	$server->loop_work();
