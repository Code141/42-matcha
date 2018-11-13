<?php

class loader
{
	public $pdo;
	public $data = array();
	public $view = array();

	public function __construct()
	{
		$this->load =& $this; 
		$this->pdo = new m_model(); 
	}
/*
	public function core_controller(string $controller)
	{
		if (is_readable(CORE_PATH . 'controllers/' . $controller . '.php'))
			require_once(CORE_PATH . 'controllers/' . $controller . '.php');
		else
			return ()
	}
 */
	public function controller(string $controller)
	{
		if (is_readable(APP_PATH . 'controllers/' . $controller . '.php'))
			require_once(APP_PATH . 'controllers/' . $controller . '.php');
		else if (is_readable(CORE_PATH . 'controllers/' . $controller . '.php'))
			require_once(CORE_PATH . 'controllers/' . $controller . '.php');
		else
			$controller = "controller";
		$called_controller = "c_" . $controller;

		$instance_ctrl = new $called_controller();
		$instance_ctrl->load =& $this;
		$instance_ctrl->data =& $this->data;
		$instance_ctrl->pdo =& $this->pdo;
		return ($instance_ctrl);
	}

	public function view(string $view)
	{
		if (is_readable(APP_PATH . 'views/' . $view . '.php'))
			require_once(APP_PATH . 'views/' . $view . '.php');
		else if (is_readable(CORE_PATH . 'views/' . $view . '.php'))
			require_once(CORE_PATH . 'views/' . $view . '.php');
		else
			$view = "view";
		$called_view = "v_" . $view;

		$instance_view = new $called_view();
		$instance_view->load =& $this;
		$instance_view->data =& $this->data;
		return ($instance_view);
	}

	public function model(string $model_file, string $model, $params = NULL)
	{
		require_once(APP_PATH . 'models/' . $model_file . '.php');
		$calledmodel = 'm_' . $model_file;
		$pdo = new $calledmodel();
		return($pdo->$model($params));
	}

	public	function	html($file)
	{
		if (is_readable(APP_PATH . 'html/' . $file . '.html'))
			require(APP_PATH . 'html/' . $file . '.html');
		else if (is_readable(CORE_PATH . 'html/' . $file . '.html'))
			require(CORE_PATH . 'html/' . $file . '.html');
		else
			echo '<h1 style="color:red;">Can\'t find view "' . $file . '" in app/ or core/</h1>'; 
	}

	public function entity(string $entity)
	{
		require_once(APP_PATH . 'entity/' . $entity . '.php');
	}

	public function script(string $type, string $file, array $data = NULL)
	{
		require_once(APP_PATH . 'script/' . $type . '/' . $file . '.' . $type);
		return ($data);
	}

}

