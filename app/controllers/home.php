<?php

class c_home extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->module->session();
		$this->core->set_view("home", "main");
	}
}
