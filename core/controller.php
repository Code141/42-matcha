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
		$this->data['title'] = "Error 404";
		$this->files['views']['center'] = '404';

		http_response_code(404);
		echo '404';
		//	$this->view();
	}

}

class c_logged_only extends c_controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_loggued())
			$this->fail("You must be loggued in", "main", "login");
	}
}

class c_public_only extends c_controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->is_loggued())
			$this->fail("You are already loggued", "main", "settings");
	}
}
