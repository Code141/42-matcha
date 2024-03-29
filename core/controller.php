<?php

class c_controller
{
	public function __construct()
	{
	}

	public function __destruct()
	{
	}

	public function	requiered_fields($keys, $array)
	{
		foreach ($keys as $key)
			if (!isset($array[$key]) || empty($array[$key]))
				return (NULL);
			else
				$new_array[$key] = $array[$key];
		return ($new_array);
	}

	protected function save_url()
	{
		$_SESSION['last_url']['controller'] = $controller;
		$_SESSION['last_url']['action'] = $action;
		$_SESSION['last_url']['params'] = $params;
	}

	public function error_404()
	{
		$this->core->fail("404", "home", "main");
	}
}

class c_logged_only extends c_controller
{
	public function __construct()
	{
		global $core;
		parent::__construct();

		if (!isset($_SESSION['user']))
			$core->fail("You must be loggued in", "home", "main");
	}

	public function error_404()
	{
		$this->core->fail("Page not found (404)", "dashboard", "main");
	}

}

class c_public_only extends c_controller
{
	public function __construct()
	{
		global $core;
		parent::__construct();

		if (isset($_SESSION['user']))
			$core->fail("You are already loggued", "dashboard", "main");
	}

	public function error_404()
	{
		$this->core->fail("Page not found (404)", "home", "main");
	}

}
