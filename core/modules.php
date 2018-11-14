<?php

class modules
{
	public $core;
	public $load;
	public $data;
	public $pdo;

	public function __call(string $name , array $arguments)
	{
		$module_name = $this->load->module($name);
		$this->$name = new $module_name();
	}
}

