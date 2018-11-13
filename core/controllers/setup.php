<?php

class c_setup extends c_controller
{
	public $load;
	public $data = array();
	public $prompter = array(
		"success" => "",
		"fail" => "");


	public function __construct()
	{
	}

	public function	main()
	{
		$this->data[] = 'SETUP';
		$mavueview = $this->load->view("setup/setup");
		$mavueview->main();
	}

	public function __destruct()
	{
	}
}

