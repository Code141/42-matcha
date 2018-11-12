<?php

class loader
{
	public function controller($controller)
	{
		if (is_readable(APP_PATH .'controllers/' . $controller . '.php'))
			require_once(APP_PATH .'controllers/' . $controller . '.php');
		else
			$controller = "controller";
		$called_controller = "c_" . $controller;
		return (new $called_controller);
	}

	public function view($view)
	{
		if (is_readable(APP_PATH .'views/' . $view . '.php'))
			require_once(APP_PATH .'views/' . $view . '.php');
		else
			$view = "view";
		$called_view = "v_" . $view;
		return (new $called_view);
	}

	public function model($model_file, $model, $params = NULL)
	{
		require_once(APP_PATH . 'models/' . $model_file . '.php');
		$calledmodel = 'm_' . $model_file;
		$pdo = new $calledmodel();
		return($pdo->$model($params));
	}

	public function entity($entity)
	{
		require_once(APP_PATH . 'entity/' . $entity . '.php');
	}

	public function script($type, $file, array $data = NULL)
	{
		require_once(APP_PATH . 'script/' . $type . '/' . $file . '.' . $type);
		return ($data);
	}



}

