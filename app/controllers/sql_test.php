<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{

		$this->view = $this->load->view("sql_test");
		$this->view->data['data_controller'] = "this data is setted into a controller";
		$this->view->main();

	}
}
