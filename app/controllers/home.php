<?php

class c_home extends c_controller
{
	public function main($params = NULL)
	{

		$this->view = $this->load->view("home");
		$this->view->main();
	}
}
