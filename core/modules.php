<?php

class module
{
}

class modules
{
	public $core;
	public $load;
	public $data;
	public $db;

	public function __call(string $name , array $arguments)
	{
		$this->$name = $this->load->module($name);
		$this->link($name);
		return ($this->$name);
	}

	public function link($name)
	{
		if (!empty($this->core->controller))
			$this->core->controller->module->$name =& $this->$name->controller;
		if (!empty($this->core->view))
			$this->core->view->module->$name =& $this->$name->view;
		if (!empty($this->core->model))
			$this->core->model->module->$name =& $this->$name->model;
	}
}


