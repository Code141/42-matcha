<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'on');

define('CORE_PATH', 'core/');
define('APP_PATH', 'app/');
define('CONFIG_PATH', 'config/');

define('DEV_MODE', TRUE);

require_once(CORE_PATH . "db.php");
require_once(APP_PATH . "models/message.php");


set_time_limit (0);
define('HOST_NAME',"localhost"); 
define('PORT',"8090");

$null = NULL;

class socket_server
{
	public function	__construct()
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

	public function disconnect()
	{
		$id = $this->find_id_user($this->current_socket);
		if ($id != null)
		{
			$msg['logout'] = $id;
			$friends = $this->get_friends($id);
			if ($friends)
				foreach ($friends as $user)
					if (($sock = $this->find_socket($user['id'])))
						$this->send($sock, $msg);
		}
		$index = array_search($this->current_socket, $this->clientSocketArray);
		unset($this->clientSocketArray[$index]);
	}

	public function incoming($socketData)
	{
		$message = json_decode($this->unseal($socketData));
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
			$msg_log['login'] = $user['id'];
			foreach($msg['friends'] as $key => $user)
			{
				if (isset($this->user[$user['id']]))
					$msg['friends'][$key]['connected'] = true;
				else
					$msg['friends'][$key]['connected'] = false;

				$sock = $this->find_socket($user['id']);
				if ($sock)
					$this->send($sock, $msg_log);

			}
			$this->send($this->current_socket, $msg);
		}

		if ($message->action == "message")
		{
			if (strlen($message->message) == 0)
				return;
			if (!empty($message->message) && !empty($message->to))
			{
				if (isset($this->user[$message->to]))
				{
					$socket_to = $this->user[$message->to]['socket'];
					$msg['message'] = array();
					$msg['message']['msg'] = $message->message;
					$msg['message']['from'] = $id;
					$msg['message']['username'] = $user['username'];
					$this->send($socket_to, $msg);
				}
				$this->new_msg($id, $message->to, $message->message);
			}
		}
	}

	public function new_msg($id_user_from, $id_user_to, $msg)
	{
		$conv = $this->m_message->find_conv($id_user_from, $id_user_to);
		if ($conv === NULL)
			return ();
	}

	public function connect()
	{
		$newSocket = socket_accept($this->socket);
		$header = socket_read($newSocket, 1024);
		$lines = preg_split("/\r\n/", $header);
		$headers = array();
		foreach($lines as $line)
			if(preg_match('/\A(\S+): (.*)\z/', chop($line), $matches))
				$headers[$matches[1]] = $matches[2];
		$secKey = $headers['Sec-WebSocket-Key'];
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



	public function auth_assoc($ssid, $current_socket)
	{
		@session_id($ssid);
		@session_start();
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

	public function broadcast($clientSocketArray, $message)
	{
		$message = $this->seal(json_encode($message));
		$messageLength = strlen($message);
		foreach($clientSocketArray as $clientSocket)
			@socket_write($clientSocket, $message, $messageLength);
		return true;
	}

	public function send($socket, $message)
	{
		$message = $this->seal(json_encode($message));
		$messageLength = strlen($message);
		@socket_write($socket, $message, $messageLength);
		return true;
	}

	public function unseal($socketData)
	{
		$length = ord($socketData[1]) & 127;
		if($length == 126) {
			$masks = substr($socketData, 4, 4);
			$data = substr($socketData, 8);
		}
		elseif($length == 127) {
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
		elseif($length > 125 && $length < 65536)
			$header = pack('CCn', $b1, 126, $length);
		elseif($length >= 65536)
			$header = pack('CCNN', $b1, 127, $length);
		return $header.$socketData;
	}

	public function __destruct()
	{
		socket_close($this->socket);
	}
}


$server = new socket_server();

$server->db = new db();
$server->db->connect_base();

$server->m_message = new m_message();
$server->m_message->db = &$server->db;


while (true)
{
	$server->loop_work();
	usleep(100);
}
