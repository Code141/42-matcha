<?php

error_reporting(E_ALL | E_STRICT);
ini_set('date.timezone', 'Europe/Paris');

ini_set('display_errors', 'on');

define('DEV_MODE', TRUE);

define('CORE_PATH', 'core/');
define('APP_PATH', 'app/');
define('CONFIG_PATH', 'config/');

set_time_limit (0);
define('HOST_NAME',"localhost"); 
define('PORT',"8090");

$null = NULL;

class	db
{
	public	$pdo;

	public function __construct()
	{
		$this->connect();
	}

	public function	connect()
	{
		require(CONFIG_PATH . 'database.php');
		try
		{
			$this->pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(PDOException $exception)
		{
			if ($exception->getCode() == 1045)
				die ("BAD BDD PASSWORD, PLEASE SEE config/database.php");
			else
				die ($exception->getMessage());
		}
	}

	public function	execute()
	{
		try
		{
			$this->stm->execute();
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}
	}

	public function get_friends($user_id)
	{
		$this->sql = "
			SELECT DISTINCT u.id, u.username
			FROM `like` l1

			LEFT JOIN `like` l2
			ON l1.id_user_to = l2.id_user_from

			LEFT JOIN user u
			ON l2.id_user_from = u.id

			WHERE l1.id_user_from = " . $user_id . "
			AND l2.id_user_to = " . $user_id;
		$this->stm = $this->pdo->prepare($this->sql);
		$this->execute();
		$friends = $this->stm->fetchAll(PDO::FETCH_ASSOC);
		return ($friends);
	}

	public function send($id_conv, $id_user_from, $id_user_to, $msg)
	{
		$this->sql = "
			INSERT INTO msg
			(id_conv, id_user_from, id_user_to, msg)
			VALUES
			(:id_conv, :id_user_from, :id_user_to, :msg)
			";
		$this->stm = $this->pdo->prepare($this->sql);
		$this->stm->bindparam("id_conv", $id_conv, PDO::PARAM_INT);
		$this->stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$this->stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$this->stm->bindparam("msg", $msg, PDO::PARAM_STR);
		$this->execute();
		return (NULL);
	}

	public function get_msg($id_conv)
	{
		$this->sql = "
			SELECT id, id_user_from, id_user_to, msg, datetime
			FROM msg
			WHERE id_conv = :id_conv
			";
		$this->stm = $this->pdo->prepare($this->sql);
		$this->stm->bindparam("id_conv", $id_conv, PDO::PARAM_INT);
		$this->execute();
		$msgs = $this->stm->fetchAll(PDO::FETCH_ASSOC);
		return ($msgs);
	}

	public function find_conv($id_user_from, $id_user_to)
	{
		$this->sql = "
				SELECT *
				FROM conv
				WHERE
				(id_user_from = :id_user_from AND id_user_to = :id_user_to)
				OR
				(id_user_to = :id_user_from AND id_user_from = :id_user_to)
			";
		$this->stm = $this->pdo->prepare($this->sql);
		$this->stm->bindparam("id_user_from", $id_user_from, PDO::PARAM_INT);
		$this->stm->bindparam("id_user_to", $id_user_to, PDO::PARAM_INT);
		$this->stm->execute();

		$conv = $this->stm->fetchAll(PDO::FETCH_ASSOC);
		if (!$this->stm->rowCount())
			return (NULL);
		return ($conv[0]);
	}

	public function __destruct()
	{
		if (!empty($this->stm))
			$this->stm->closeCursor();
		$this->stm = NULL;
		$this->pdo = NULL;
	}
}

class socket_server
{
	public function __construct()
	{
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
		if (empty($this->working_sokets))
			return;

		socket_select($this->working_sokets, $null, $null, 0, 10);	// FILTRE LES SOCKECT MODIFIE
		if (in_array($this->socket, $this->working_sokets)) // Si un des socket a ete modifie
			$this->connect();
		foreach ($this->working_sokets as $current_socket)
		{
			$this->current_socket = $current_socket;
			if (socket_recv($current_socket, $socketData, 2048, 0) > 0)
				$this->incoming($socketData);
			else
			{
				$socketData = @socket_read($this->current_socket, 2048, PHP_NORMAL_READ);
				if ($socketData === false)
					$this->disconnect();
			}
		}
	}

	public function incoming($socketData)
	{
		$message = json_decode($this->unseal($socketData));
		if (empty($message))
			return;
		$id = $this->find_id_user($this->current_socket);
		if ($id == null)
			return;
		$user = $this->user[$id];
		if ($message->action == "close")
		{
			$index = array_search($this->current_socket, $this->clientSocketArray);
			unset($this->clientSocketArray[$index]);
			socket_shutdown($this->current_socket);
			socket_close($this->current_socket);
			return ;
		}
		if ($message->action == "friends")
		{
			$msg['friends'] = $this->db->get_friends($id);
			$msg_log['login'] = $user['id'];
			foreach($msg['friends'] as $key => $user)
			{
				if (isset($this->user[$user['id']]))
					$msg['friends'][$key]['connected'] = true;
				else
					$msg['friends'][$key]['connected'] = false;
				$this->send($user['id'], $msg_log);
			}
			$this->send($id, $msg);
		}
		if ($message->action == "message")
		{
			if (strlen($message->message) == 0)
				return;
			if (!empty($message->message) && !empty($message->to))
			{

				// ARE THEY FRIENDS ????
				// ARE THEY FRIENDS ????
				// ARE THEY FRIENDS ????
				// ARE THEY FRIENDS ????

				$conv = $this->db->find_conv($id,  $message->to);
				if ($conv === NULL)
					return ;
				$this->db->send($conv['id'], $id, $message->to, $message->message);

				if (isset($this->user[$message->to]))
				{
					$msg['message'] = array();
					$msg['message']['msg'] = $message->message;
					$msg['message']['from'] = $id;
					$msg['message']['username'] = $user['username'];
					$this->send($message->to, $msg);
				}
			}
		}
		if ($message->action == "previous_message")
		{
			if (!empty($message->id))
			{
				$conv = $this->db->find_conv($id,  $message->id);
				if ($conv === NULL)
					return ;
				$msgs = $this->db->get_msg($conv['id']);
				$msg['previous_message'] = array();
				$msg['previous_message']['id'] = $message->id;
				$msg['previous_message']['msgs'] = $msgs;
				$this->send($id, $msg);
			}
		}
	}

	public function get_literal($msg)
	{
		$message = json_decode($msg);
		if (empty($message->ssid_non_relink))
			return;
		$user = $this->auth($message->ssid_non_relink);
		if (!$user)
			return;
		if ($message->action == "like")
		{
			$msg = array();
			$msg['like'] = array();
			$msg['like']['from'] = intval($user['id']);
			$msg['like']['username'] = $user['username'];
			$msg['like']['to'] = $message->to;
			$msg['like']['date'] = date("G:i");
			$this->send($message->to, $msg);
		}
		if ($message->action == "matche")
		{
			$msg = array();
			$msg['matche'] = array();
			$msg['matche']['from'] = intval($user['id']);
			$msg['matche']['username'] = $user['username'];
			$msg['matche']['to'] = $message->to;
			$msg['matche']['date'] = date("G:i");
			$this->send($message->to, $msg);
		}
	
		if ($message->action == "dislike")
		{
			$msg = array();
			$msg['dislike'] = array();
			$msg['dislike']['from'] = intval($user['id']);
			$msg['dislike']['username'] = $user['username'];
			$msg['dislike']['to'] = $message->to;
			$msg['dislike']['date'] = date("G:i");
			$this->send($message->to, $msg);
		}

		if ($message->action == "history")
		{
			$msg = array();
			$msg['history'] = array();
			$msg['history']['from'] = intval($user['id']);
			$msg['history']['username'] = $user['username'];
			$msg['history']['to'] = $message->to;
			$msg['history']['date'] = date("G:i");
			$this->send($message->to, $msg);
		}

	}

	public function auth($ssid)
	{
		@session_id($ssid);
		@session_start();
		if (empty($_SESSION['user']))
			return (false);
		//		socket_getpeername($current_socket, $client_ip_address);
		//			|| empty($_SESSION['USER']['IP']) != socket_ip)
		//			|| empty($_SESSION['USER']['websocket_token']))

		$user = $_SESSION['user'];
		session_write_close();
		return ($user);
	}

	public function disconnect()
	{
		$id = $this->find_id_user($this->current_socket);
		if ($id != null)
		{
			$msg['logout'] = $id;
			$friends = $this->db->get_friends($id);
			if ($friends)
				foreach ($friends as $user)
					$this->send($user['id'], $msg);
		}
//		socket_shutdown($this->current_socket);
		socket_close($this->current_socket);
		$index = array_search($this->current_socket, $this->clientSocketArray);
		unset($this->clientSocketArray[$index]);
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

	public function broadcast($clientSocketArray, $message)
	{
		$message = $this->seal(json_encode($message));
		$messageLength = strlen($message);
		foreach($clientSocketArray as $clientSocket)
			@socket_write($clientSocket, $message, $messageLength);
		return true;
	}

	public function send($id, $message)
	{
		$socket = $this->find_socket($id);
		if (!$socket)
			return;
		$message = $this->seal(json_encode($message));
		$messageLength = strlen($message);
		@socket_write($socket, $message, $messageLength);
	}

	public function connect()
	{
		$newSocket = socket_accept($this->socket);
		$msg = socket_read($newSocket, 1024);


		$header = $msg;
		$lines = preg_split("/\r\n/", $header);
		$headers = array();
		foreach($lines as $line)
			if(preg_match('/\A(\S+): (.*)\z/', chop($line), $matches))
				$headers[$matches[1]] = $matches[2];
		if (empty($headers['Sec-WebSocket-Key']))
		{
			$this->get_literal($msg);
			$newSocketIndex = array_search($this->socket, $this->working_sokets);
			unset($this->working_sokets[$newSocketIndex]);
			return;
		}
		$secKey = $headers['Sec-WebSocket-Key'];
		if (empty($headers['Cookie']))
			return;
		$cookie = $headers['Cookie'];
		$ssid = explode("=", $cookie)[1];
		if (isset($ssid))
		{
			$user = $this->auth($ssid);
			if (!$user)
				return;
			$this->user[$user['id']] = $user;
			$this->user[$user['id']]['socket'] = $newSocket;
		}
		$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
		$buffer  =
			"HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
			"Upgrade: websocket\r\n" .
			"Connection: keep-alive, Upgrade\r\n" .
			"WebSocket-Origin: " . HOST_NAME . "\r\n" .
			"WebSocket-Location: ws://" . HOST_NAME . ":" . PORT . "\r\n".
			"Sec-WebSocket-Accept: " . $secAccept . "\r\n\r\n";
		socket_write($newSocket, $buffer, strlen($buffer));
		$this->clientSocketArray[] = $newSocket;
		$newSocketIndex = array_search($this->socket, $this->working_sokets);
		unset($this->working_sokets[$newSocketIndex]);
	}

	public function unseal($socketData)
	{
		$length = ord($socketData[1]) & 127;

		if($length == 126) {
			$masks = substr($socketData, 4, 4);
			$data = substr($socketData, 8);
		}
		else if($length == 127) {
			$masks = substr($socketData, 10, 4);
			$data = substr($socketData, 14);
		}
		else {
			$masks = substr($socketData, 2, 4);
			$data = substr($socketData, 6);
		}
		$socketData = "";
		for ($i = 0; $i < strlen($data); ++$i) {
			$socketData .= $data[$i] ^ $masks[$i%4];
		}
		return $socketData;
	}

	public function seal($socketData)
	{
		$b1 = 0x80 | (0x1 & 0x0f);
		$length = strlen($socketData);

		if($length <= 125)
			$header = pack('CC', $b1, $length);
		else if($length > 125 && $length < 65536)
			$header = pack('CCn', $b1, 126, $length);
		else if($length >= 65536)
			$header = pack('CCN', $b1, 127, $length);
		return $header . $socketData;
	}

	public function __destruct()
	{
		socket_close($this->socket);
	}
}

$server = new socket_server();

$server->db = new db();

while (true)
	$server->loop_work();
