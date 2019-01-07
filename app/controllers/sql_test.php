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
		$path = SERVER_ROOT . 'app/assets/pictures';
		$handle = opendir($path . '1');
		while (false !== ($file = readdir($handle))) {
	        if ($file != "." && $file != "..") 
				$files[] = $file;
		}
		closedir($handle);
		$new_name = array();
 		for ($i = 0; $i < count($files); $i++) {
			$new_name = preg_replace("/^[^\.]+/", ($i + 1), $files[$i]);
			rename($files[$i], $new_name);
			echo $new_name[$i] . '<br><br>';
			var_dump($files[$i]);
		}
		$last_i =  $i;
/*		foreach ($files as $file) {
			 rename($file, $ . "_thumb.gif");
		 }
	 */	echo 'got it<br>';
	/*	$this->module_loader->session();
	$user = $this->module->session->user_loggued();*/
		$PublicIP = $this->get_client_ip();
		$this->core->set_view("sql_test", "main");
	}
}

