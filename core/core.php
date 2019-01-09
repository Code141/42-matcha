<?php

class core
{
	public $request;

	public $db;
	public $load;

	public $data = array(
	'prompter' => array(
		"success" => "",
		"fail" => "")
	);

	public $controller = NULL;
	public $view = NULL;
	public $module_loader = NULL;



	public function consolelog($msg)
	{
		echo "<script>console.log('" . $msg . "');</script>";
	}


	public function __construct()
	{
		$this->request = $this->parse_uri($_SERVER['REQUEST_URI']);

		$this->load = new loader();
		$this->module_loader = new module_loader();
		$this->db = new db();

		$this->load->core =& $this;
		$this->load->data =& $this->data;
		$this->db->core =& $this;
		$this->db->data =& $this->data;
		$this->module_loader->core =& $this;
		$this->module_loader->load =& $this->load;
		$this->module_loader->data =& $this->data;

		if ($this->request['controller'] != "setup")
			$this->db->connect_base();
		else
			$this->db->set_up_connect();
	}

	public function	new_controller(string $controller_name = NULL)
	{
		if (isset($this->controller))
			unset($this->controller);

		$this->controller = $this->load->controller($controller_name);
		if ($this->controller === NULL)
			die ("CORE CAN'T LOAD CONTROLLER (404!)");
	}

	public function	execute_controller($action_name)
	{
		$controller_classes = get_class_methods($this->controller);

		$public_classes = preg_grep("/^(?!__).+/", $controller_classes);
		if (array_search($action_name, $public_classes) === FALSE)
			$action = "error_404";
		else
			$action = $action_name;

		$this->controller->$action($this->request['params']);
	}

	public function	set_view(string $view_name = NULL, string $action_name = NULL)
	{
		$this->view = $this->load->view($view_name);
		if ($this->view === NULL)
			die ("CORE CAN'T LOAD VIEW " . $view_name);
		$this->view->$action_name($this->request['params']);
		die();
	}

	public function fail(string $msg = NULL, string $controller = NULL, string $action = NULL)
	{
		if ($msg === NULL)
			$msg = "Fail for unknow reason";
/*
		if ($action == NULL)
			$action = $_SESSION['last_url']['action'];
		if ($controller == NULL)
			$controller = $_SESSION['last_url']['controller'];
*/
		$this->new_controller($controller);
		$this->data['prompter']['fail'] = $msg;
		$this->execute_controller($action);
		die(); /////// REQUIERED (SWITCH CONTROLLER DOESNT WORK YET)
	}

	public function success($msg = NULL, $controller = NULL, $action = NULL)
	{
		if ($msg === NULL)
			$msg = "Success";
/*
		if ($action == NULL)
			$action = $_SESSION['last_url']['action'];
		if ($controller == NULL)
			$controller = $_SESSION['last_url']['controller'];
*/
		$this->new_controller($controller);
		$this->data['prompter']['success'] = $msg;
		$this->execute_controller($action);
		die(); /////// REQUIERED (SWITCH CONTROLLER DOESNT WORK YET)
	}

	protected function cookie_set($cookie_key, $cookie_value)
	{
		$expire = 10000;
		setcookie($cookie_key, $cookie_value, time() + $expire);
	}

	protected function cookie_get($cookie_key)
	{
		if (!isset($_COOKIE[$cookie_key]))
			return ($_COOKIE[$cookie_key]);
		else
			return (NULL);
	}

	public function	parse_uri(string $uri)
	{
		$pattern = "~^" . SITE_ROOT . "~";
		$uri = preg_replace($pattern, "", $uri);
		$uri = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $uri);
		$uri = strtok($uri, '?');
		$uri = trim($uri, '/');
		$exploded_uri = explode('/', $uri);
		$request['controller'] = ($exploded_uri[0] != '') ? $exploded_uri[0] : DEFAULT_CONTROLLER;
		$request['action'] = (isset($exploded_uri[1])) ? $exploded_uri[1] : DEFAUT_ACTION;
		$request['params'] = (isset($exploded_uri[2])) ? array_slice($exploded_uri, 2) : NULL;
		return ($request);
	}

}
