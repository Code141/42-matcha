<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'on');

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
		{
			$this->current_socket = $current_socket;
			if (socket_recv($current_socket, $socketData, 2048, 0) > 0)
				$this->incoming($socketData);
		}
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

	public function auth_assoc($ssid, $current_socket)
	{
		session_id($ssid);
		session_start();
		if (empty($_SESSION['user']))
			return (false);
		//		socket_getpeername($current_socket, $client_ip_address);
		//			|| empty($_SESSION['USER']['IP']) != socket_ip)
		//			|| empty($_SESSION['USER']['websocket_token']))

		$user = $_SESSION['user'];

		$this->user[$user['id']] = $user;
		$this->user[$user['id']]['socket'] = $current_socket;

		session_write_close();

		return (true);
	}

	public function	find_socket($id_user)
	{
		if (isset($this->user[$id_user]))
				return ($this->user[$id_user]['socket']);
		return (null);
	}

	public function	find_id_user($socket)
	{
		foreach ($this->user as $id => $user)
			if ($this->user[$id]['socket'] == $socket)
				return ($id);
		return (null);
	}

	public function get_friends($user_id)
	{
		$this->db->sql = "
			SELECT u.id, u.username
			FROM `like` l1
			LEFT JOIN `like` l2
			ON l1.id_user_to = l2.id_user_from
			LEFT JOIN user u
			ON l2.id_user_from = u.id
			WHERE l1.id_user_from = " . $user_id . "
			AND l2.id_user_to = " . $user_id;
		$stm = $this->db->execute_pdo();
		$stm = $stm->fetchAll(PDO::FETCH_ASSOC);
		return ($stm);
	}
	
	public function incoming($socketData)
	{
		$message = json_decode($this->chat->unseal($socketData));
		if (empty($message))
			return;

		if (isset($message->ssid))
			if (!$this->auth_assoc($message->ssid, $this->current_socket))
				return;

		$id = $this->find_id_user($this->current_socket);
		if ($id == null)
			return;

		$user = $this->user[$id];
		if ($message->action == "friends")
		{
			$msg['friends'] = $this->get_friends($id);
			$this->chat->send($this->current_socket, $msg);
		}

		if ($message->action == "message")
		{
			if (!empty($message->message) && !empty($message->to))
			{
				if (isset($this->user[$message->to]))
				{
					$socket_to = $this->user[$message->to]['socket'];
					$msg['message'] = array();
					$msg['message']['msg'] = $message->message;
					$msg['message']['from'] = $id;
					$msg['message']['username'] = $user['username'];
					$this->chat->send($socket_to, $msg);
				}
			}

		}
		return;
		$socketData = socket_read($this->current_socket, 1024, PHP_NORMAL_READ);
		if ($socketData === false)
		{
			$newSocketIndex = array_search($this->current_socket, $this->clientSocketArray);
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
{
	$server->loop_work();
//	usleep(500);
}
