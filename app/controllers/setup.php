<?php

class c_setup extends c_controller
{
	public function main($params = NULL)
	{
		$mavue = $this->view = $this->load->view("setup");
		$this->view->main();
	}
}
