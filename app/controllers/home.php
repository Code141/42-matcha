<?php

class c_home extends c_public_only
{
	public function main($params = NULL)
	{
		$this->core->set_view("home", "main");
	}
}
