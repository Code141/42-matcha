<?php

class loader
{
	private function file_loader($filename)
	{
		if (is_readable(APP_PATH . 'controllers/' . $filename . '.php'))
			require_once(APP_PATH . 'controllers/' . $filename . '.php');
		else if (is_readable(CORE_PATH . 'controllers/' . $filename . '.php'))
			require_once(CORE_PATH . 'controllers/' . $filename . '.php');
		else
			die ("cant load file");
	}
	public function controller(string $controller)
	{
		$this->file_loader($controller);

		$controller_name = "c_" . $controller;
		if (!class_exists($controller_name))
			return (NULL);
		return ($controller_name);
	}

	public function view(string $view)
	{
		if (is_readable(APP_PATH . 'views/' . $view . '.php'))
			require_once(APP_PATH . 'views/' . $view . '.php');
		else if (is_readable(CORE_PATH . 'views/' . $view . '.php'))
			require_once(CORE_PATH . 'views/' . $view . '.php');
		else
			return (NULL);
		$view_name = "v_" . $view;
		if (!class_exists($view_name))
			return (NULL);

		$view = new $view_name();
		$view->load =& $this;
		$view->core =& $this->core;
		$view->data =& $this->data;

		return ($view);
	}

	public function module(string $module = null)
	{
		if (is_readable(CORE_PATH . 'modules/' . $module . '.php'))
			require_once(CORE_PATH . 'modules/' . $module . '.php');
		else
			die ("Can't find '" . $module . "' module file ! Die;");

		$module_name = "module_" . $module;

		if (!class_exists($module_name))
			die ("Can't load '" . $module_name . "' class ! Die;");

		return ($module_name);
	}

	public function model(string $model)
	{
		if (is_readable(APP_PATH . 'models/' . $model . '.php'))
			require_once(APP_PATH . 'models/' . $model . '.php');
		else
			die ("Can't find '" . $name . "' model file ! Die;");
		$calledmodel = 'm_' . $model;

		$model = new $calledmodel();
		$model->db = &$this->core->db;

		return ($model);
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

	public	function	html(string $file)
	{
		if (is_readable(APP_PATH . 'html/' . $file . '.html'))
			require(APP_PATH . 'html/' . $file . '.html');
		else if (is_readable(CORE_PATH . 'html/' . $file . '.html'))
			require(CORE_PATH . 'html/' . $file . '.html');
		else
			echo '<h1 style="color:red;">Can\'t find view "' . $file . '" in app/ or core/</h1>'; 
	}
}
