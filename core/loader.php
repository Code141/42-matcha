<?php

class loader
{
	public function controller(string $controller)
	{
		if (is_readable(APP_PATH . 'controllers/' . $controller . '.php'))
			require_once(APP_PATH . 'controllers/' . $controller . '.php');
		else if (is_readable(CORE_PATH . 'controllers/' . $controller . '.php'))
			require_once(CORE_PATH . 'controllers/' . $controller . '.php');
		else
			return (NULL);
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
		return ($view_name);
	}

	public function module(string $name = null)
	{
		if (is_readable(CORE_PATH . 'modules/' . $name . '.php'))
			require_once(CORE_PATH . 'modules/' . $name . '.php');
		else
			die ("Can't find '" . $name . "' module file ! Die;");
		$module_name = "module_" . $name;
		if (!class_exists($module_name))
			die ("Can't load '" . $module_name . "' class ! Die;");
		return ($module_name);
	}

	public function model(string $model_file, string $model, $params = NULL)
	{
		require_once(APP_PATH . 'models/' . $model_file . '.php');
		$calledmodel = 'm_' . $model_file;
		$pdo = new $calledmodel();
		return($pdo->$model($params));
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
