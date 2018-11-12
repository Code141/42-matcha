<?php

class c_home extends c_controller
{
	public function main($params = NULL)
	{
		$this->view = $this->load->view("home");
		$this->view->data['data_controller'] = "this data is setted into a controller";
		$this->view->main();
	}
}
