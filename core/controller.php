<?php

class c_controller
{
	public $data = array();
	public $prompter = array(
		"success" => "",
		"fail" => "");
	
	public function __construct()
	{
		$this->load = new loader();
		$this->load->entity('user');
		$this->load->entity('email');
	}

	private function protect_html_injection(array $data)
	{
		foreach ($data as $key => $value)
			if (is_string($value))
				$data[$key] = htmlspecialchars($value);
			else if (is_array($value))
				$data[$key] = $this->protect_html_injection($value);
			else
				$data[$key] = $value;
		return ($data);
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
		//	$this->view();
	}

	protected function fail($msg = NULL, $action = NULL, $controller = NULL, $params = NULL)
	{
		if ($msg === NULL)
			$msg = "Fail for unknow reason";

		if ($action == NULL)
			$action = $_SESSION['last_url']['action'];
		if ($controller == NULL)
			$controller = $_SESSION['last_url']['controller'];
		if ($params == NULL)
			$params = $_SESSION['last_url']['params'];

		$controller = $this->load->controller($controller);
		$controller->prompter['fail'] = $msg;
		$controller->$action($params);
		die ();
	}

	protected function success($msg = NULL, $action = NULL, $controller = NULL, $params = NULL)
	{
		if ($msg === NULL)
			$msg = "Success";

		if ($action == NULL)
			$action = $_SESSION['last_url']['action'];
		if ($controller == NULL)
			$controller = $_SESSION['last_url']['controller'];
		if ($params == NULL && isset($_SESSION['last_url']['params']))
		{
			$params = $_SESSION['last_url']['params'];
		}

		$controller = $this->load->controller($controller);
		$controller->prompter['success'] = $msg;
		$controller->$action($params);
		die ();
	}

	protected function cookie_set($cookie_key, $cookie_value)
	{
		$expire = 10000;
		setcookie($cookie_key, $cookie_value, time() + $expire);
	}

	protected function cookie_get($cookie_key)
	{
		return ($_COOKIE[$cookie_key]);
	}

	protected function	requiered_fields($keys, $array)
	{
		foreach ($keys as $key)
			if (!isset($array[$key]) || empty($array[$key]))
				return (NULL);
			else
				$new_array[$key] = $array[$key];
		return ($new_array);
	}

	public function __destruct()
	{
	}
}

class c_logged_only extends c_controller
{
	public function __construct()
	{
		parent::__construct();
		if (!is_loggued())
			$this->fail("You must be loggued in", "main", "login");
	}
}

class c_public_only extends c_controller
{
	public function __construct()
	{
		parent::__construct();
		if (is_loggued())
			$this->fail("You are already loggued", "main", "settings");
	}
}
