<?php

class c_module_websocket extends c_controller
{
	public function	__construct()
	{
		//		 CHECK IF SERV IS LUNCHED
	//			shell_exec('sh ./core/modules/websocket/start_server.sh');
		//		$_SESSION['USER']['websocket_token'] == eirugh;
	}

	public function	send($msg)
	{
		define('HOST_NAME',"localhost"); 
		define('PORT',"8090");

		$auth['ssid_non_relink'] = session_id();
		$msg = json_encode(array_merge($auth, $msg));
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		@socket_connect($socket, HOST_NAME, PORT);
		@socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
		@socket_write($socket, $msg, strlen($msg));
		@socket_shutdown($socket, 2);
		@socket_close($socket);
	}
	
	public function	send_like($id)
	{
		$msg = array();
		$msg['action'] = "like";
		$msg['to'] = $id;
		$this->send($msg);
	}

	public function	send_matche($id)
	{
		$msg = array();
		$msg['action'] = "matche";
		$msg['to'] = $id;
		$this->send($msg);
	}


	public function	send_dislike($id)
	{
		$msg = array();
		$msg['action'] = "dislike";
		$msg['to'] = $id;
		$this->send($msg);
	}


	public function	send_visit($id)
	{
		$msg = array();
		$msg['action'] = "history";
		$msg['to'] = $id;
		$this->send($msg);
	}

}

