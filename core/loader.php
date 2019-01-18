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
			$this->core->fail("404", "home", "main");
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
		$controller->json =& $this->json;
		$controller->module_loader =& $this->core->module_loader;

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
		$view->module_loader =& $this->core->module_loader;
		$view->json =& $this->json;
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
		$model->module_loader =& $this->core->module_loader;
		return ($model);
	}

	public function module(string $name = null)
	{
		$m_file = 'modules/' . $name . '/m_' . $name . '.php';
		$v_file = 'modules/' . $name . '/v_' . $name. '.php';
		$c_file = 'modules/' . $name . '/c_' . $name . '.php';

		$class_name_m = "m_module_" . $name;
		$class_name_v = "v_module_" . $name;
		$class_name_c = "c_module_" . $name;

		if (!class_exists($class_name_m))
			if (is_readable(CORE_PATH . $m_file))
				require_once($m_file);
		if (!class_exists($class_name_v))
			if (is_readable(CORE_PATH . $v_file))
				require_once($v_file);
		if (!class_exists($class_name_c))
			if (is_readable(CORE_PATH . $c_file))
				require_once($c_file);

		$module = new module($name);

		if (class_exists($class_name_m))
		{
			$module->model = new $class_name_m();
			$module->model->self =& $module;
			$module->model->core =& $this->core;
			$module->model->load =& $this;
			$module->model->data =& $this->data;
			$module->model->db = &$this->core->db;
			$module->model->modules = &$this->core->module_loader;
		}
		if (class_exists($class_name_v))
		{
			$module->view = new $class_name_v();
			$module->view->core =& $this->core;
			$module->view->self =& $module;
			$module->view->load =& $this;
			$module->view->data =& $this->data;
			$module->view->modules = &$this->core->module_loader;
		}
		if (class_exists($class_name_c))
		{
			$module->controller = new $class_name_c();
			$module->controller->core =& $this->core;
			$module->controller->self =& $module;
			$module->controller->load =& $this;
			$module->controller->data =& $this->data;
			$module->controller->modules = &$this->core->module_loader;
		}
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
