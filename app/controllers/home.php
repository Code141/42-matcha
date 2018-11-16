<?php

class c_home extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->set_view("home", "main");
	}
}
