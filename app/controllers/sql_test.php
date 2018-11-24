<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		print_r($_SERVER);
	/*	$this->module_loader->session();
	$user = $this->module->session->user_loggued();*/
		echo "<br>--------------<br>";
		var_dump($_SERVER['HTTP_CLIENT_IP']);
		echo "<br>--------------<br>";
		var_dump($_SERVER['HTTP_X_FORWARDED_FOR']);
		echo "<br>--------------<br>";
		var_dump($_SERVER['HTTP_X_FORWARDED']);
		echo "<br>--------------<br>";
		var_dump($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']);
		echo "<br>--------------<br>";
		var_dump($_SERVER['HTTP_FORWARDED_FOR']);
		echo "<br>--------------<br>";
		var_dump($_SERVER['HTTP_FORWARDED']);
		echo "<br>--------------<br>";
		var_dump($_SERVER['REMOTE_ADDR']);
		echo "<br>--------------<br>";
		$this->core->set_view("sql_test", "main");
	}
}

