<?php

class c_sql_test extends c_controller
{
	private function get_client_ip() 
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
		   $ipaddress = $_SERVER['REMOTE_ADDR'];
	   else
		   $ipaddress = 'UNKNOWN';
      return $ipaddress;
	}

	public function main($params = NULL)
	{
	/*	$this->module_loader->session();
	$user = $this->module->session->user_loggued();*/
		$PublicIP = $this->get_client_ip();
		$this->core->set_view("sql_test", "main");
	}
}

