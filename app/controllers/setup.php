<?php

class c_setup extends c_controller
{
	public function main($params = NULL)
	{
		/*
		echo 'toto';
		$mavue = $this->load->view("setup");
		$mavue->main();
		*/

		$this->core->set_view("setup", "main");
	}
}
