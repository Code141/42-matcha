<?php

class c_account extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->set_view("account", "main");
	}
}
