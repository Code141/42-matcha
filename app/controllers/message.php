<?php

class c_message extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->set_view("message", "main");
	}
}
