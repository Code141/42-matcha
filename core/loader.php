<?php

class loader
{
	private function file_loader($file)
	{
		if (is_readable(APP_PATH . $file))
			require_once(APP_PATH . $file);
		else if (is_readable(CORE_PATH . $file))
			require_once(CORE_PATH . $file);
		else
			die ("Can't load file " . $file);
	}

	public function controller(string $name)
	{
		$file = 'controllers/' . $name . '.php';
		$class_name = "c_" . $name;

		if (!class_exists($class_name))
			$this->file_loader($file);
		if (!class_exists($class_name))
			return (NULL);

		$controller = new $class_name();

		$controller->load =& $this;
		$controller->core =& $this->core;
		$controller->data =& $this->data;
		$controller->modules =& $this->core->modules;
		return ($controller);
	}

	public function view(string $name)
	{
		$file = 'views/' . $name . '.php';
		$class_name = "v_" . $name;
		if (!class_exists($class_name))
			$this->file_loader($file);
		if (!class_exists($class_name))
			return (NULL);

		$view = new $class_name();

		$view->load =& $this;
		$view->core =& $this->core;
		$view->data =& $this->data;
		$view->modules =& $this->core->modules;
		return ($view);
	}

	public function model(string $name)
	{
		$file = 'models/' . $name . '.php';
		$class_name = "m_" . $name;
		if (!class_exists($class_name))
			$this->file_loader($file);
		if (!class_exists($class_name))
			return (NULL);

		$model = new $class_name();

		$model->load =& $this;
		$model->core =& $this->core;
		$model->data =& $this->data;
		$model->db = &$this->core->db;
		return ($model);
	}


	public function module(string $name = null)
	{
		$class_name_m = "m_" . $name;
		$class_name_v = "v_" . $name;
		$class_name_c = "c_" . $name;

		$m_file = 'modules/' . $name . '/' . $class_name_m . '.php';
		$v_file = 'modules/' . $name . '/' . $class_name_v. '.php';
		$c_file = 'modules/' . $name . '/' . $class_name_c . '.php';

		if (!class_exists($class_name_m))
			if (is_readable(CORE_PATH . $m_file))
				require_once($m_file);
		if (!class_exists($class_name_v))
			if (is_readable(CORE_PATH . $v_file))
				require_once($v_file);
		if (!class_exists($class_name_c))
			if (is_readable(CORE_PATH . $c_file))
				require_once($c_file);

		$module = new module();

		if (class_exists($class_name_m))
		{
			$module->model = new $class_name_m();
			$module->model->load =& $this;
			$module->model->core =& $this->core;
			$module->model->data =& $this->data;
			$module->model->db = &$this->core->db;
		}
		if (class_exists($class_name_v))
		{
			$module->view = new $class_name_v();
			$module->view->load =& $this;
			$module->view->core =& $this->core;
			$module->view->data =& $this->data;
			$module->view->modules =& $this->core->modules;
		}
		if (class_exists($class_name_c))
		{
			$module->controller = new $class_name_c();
			$module->controller->load =& $this;
			$module->controller->core =& $this->core;
			$module->controller->data =& $this->data;
			$module->controller->modules =& $this->core->modules;
		}

		$module->controller->self =& $module;
		$module->model->self =& $module;
		$module->view->self =& $module;

		return ($module);
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
