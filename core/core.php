<?php

class core
{
	public $request;

	public $pdo;
	public $load;

	public $data;
	public $modules;

	public $controller;
	public $view;

	public function __construct($request)
	{
		$this->request = $request;

		$this->load = new loader();
		$this->load->core =& $this;
		$this->load->data =& $this->data;

		$this->pdo = new bdd_pdo();
		$this->pdo->core =& $this;
		$this->pdo->load =& $this->load;
		$this->pdo->data =& $this->data;
		$this->pdo->pdo =& $this->pdo;
		$this->pdo->connect();

		$this->module = new modules();
		$this->module->core =& $this;
		$this->module->load =& $this->load;
		$this->module->data =& $this->data;
		$this->module->pdo =& $this->pdo;
	}

	public function	new_controller(string $controller_name = NULL)
	{
		if (isset($this->controller))
			unset($this->controller);

		$controller_name = $this->load->controller($controller_name);
		if ($controller_name === NULL)
			die ("CORE CAN'T LOAD CONTROLLER");

		$this->controller = new $controller_name();
		$this->controller->core =& $this;
		$this->controller->load =& $this->load;
		$this->controller->data =& $this->data;
		$this->controller->pdo =& $this->pdo;
	}

	public function	execute_controller($action_name)
	{
		$controller_classes = get_class_methods($this->controller);
		$public_classes = preg_grep("/^(?!__).+/", $controller_classes);
		if (array_search($action_name, $public_classes) === FALSE)
			$action = "error_404";
		else
			$action = $this->request['action'];
		$this->controller->$action($this->request['params']);
	}

	public function	set_view(string $view_name = NULL, string $action_name = NULL)
	{
		$view_name = $this->load->view($view_name);
		if ($view_name === NULL)
			die ("CORE CAN'T LOAD VIEW");

		$this->view = new $view_name();
		$this->view->core =& $this;
		$this->view->load =& $this->load;
		$this->view->data =& $this->data;
		$this->execute_view($action_name);
	}

	public function	execute_view($action_name)
	{
		$view_classes = get_class_methods($this->controller);
		$public_classes = preg_grep("/^(?!__).+/", $view_classes);

		if (array_search($action_name, $public_classes) === FALSE)
			$action = "error_404";
		else
			$action = $this->request['action'];

		$this->view->$action($this->request['params']);
	}

	public function	load_module(string $controller_name = NULL)
	{
		$controller_name = $this->load->controller($controller_name);
		if ($controller_name === NULL)
			die ("CORE CAN'T LOAD CONTROLLER");

		$this->controller = new $controller_name();
		$this->controller->core =& $this;
		$this->controller->load =& $this->load;
		$this->controller->data =& $this->data;
		$this->controller->pdo =& $this->pdo;
	}

	public function fail(string $msg = NULL, string $controller = NULL, string $action = NULL)
	{
		if ($msg === NULL)
			$msg = "Fail for unknow reason";
		if ($action == NULL)
			$action = $_SESSION['last_url']['action'];
		if ($controller == NULL)
			$controller = $_SESSION['last_url']['controller'];
		$this->new_controller($controller);
		$this->controller->prompter['fail'] = $msg;
		$this->execute_controller($action);
	}

	public function success($msg = NULL, $controller = NULL, $action = NULL)
	{
		if ($msg === NULL)
			$msg = "Success";
		if ($action == NULL)
			$action = $_SESSION['last_url']['action'];
		if ($controller == NULL)
			$controller = $_SESSION['last_url']['controller'];
		$this->new_controller($controller);
		$this->controller->prompter['success'] = $msg;
		$this->execute_controller($action);
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

}
