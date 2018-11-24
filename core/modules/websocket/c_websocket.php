<?php

class c_module_websocket extends c_controller
{
	public function	__construct()
	{
		// CHECK IF SERV IS LUNCHED

		echo shell_exec('sh ./core/modules/websocket/start_server.sh');


	}
}

