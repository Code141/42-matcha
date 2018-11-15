<?php

class loader
{
	private function file_loader($filepath, $filename)
	{
		$file = $filepath . $filename . '.php';
		if (is_readable(APP_PATH . $file))
			require_once(APP_PATH . $file);
		else if (is_readable(CORE_PATH . $file))
			require_once(CORE_PATH . $file);
		else
			die ("Can't load file " . $file);
	}

	public function controller(string $name)
	{
		$class_name = "c_" . $name;
		if (!class_exists($class_name))
			$this->file_loader('controllers/', $name);
		if (!class_exists($class_name))
			return (NULL);

		$controller = new $class_name();

		$controller->load =& $this;
		$controller->core =& $this->core;
		$controller->data =& $this->data;
		return ($controller);
	}

	public function view(string $name)
	{
		$class_name = "v_" . $name;
		if (!class_exists($class_name))
			$this->file_loader('views/', $name);
		if (!class_exists($class_name))
			return (NULL);

		$view = new $class_name();

		$view->load =& $this;
		$view->core =& $this->core;
		$view->data =& $this->data;
		return ($view);
	}

	public function model(string $name)
	{
		$class_name = "m_" . $name;
		if (!class_exists($class_name))
			$this->file_loader('models/', $name);
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
		$class_name = "module_" . $name;
		if (!class_exists($class_name))
			$this->file_loader('modules/', $name);
		if (!class_exists($class_name))
			return (NULL);

		$module = new $class_name();

		$module->load =& $this;
		$module->core =& $this->core;
		$module->data =& $this->data;
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
