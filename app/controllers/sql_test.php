<?php

class c_sql_test extends c_controller
{
	public function __construct()
	{
		parent::__construct();

	}

	public function main($params = NULL)
	{

		$this->load->module("login");

		$this->data['data_controller'] = "this data is setted into a controller";
		$columns = array ("*");
		$this->data['sql'] = $this->pdo
			->select(array("*"),"user")
			->where("id", "=" ,"1")
			->and("username", "=", "fiofy");
		
		$this->data['executed'] = $this->pdo->execute_pdo()->fetchAll();

		$this->load->view("sql_test")->main();
	}
}
