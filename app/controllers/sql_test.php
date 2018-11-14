<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{

		$this->data['data_controller'] = "this data is setted into a controller";
		$this->data['sql'] = $this->pdo
			->select(array("*"),"user")
			->where("id", "=" ,"1")
			->and("username", "=", "fiofy");
		
		$this->data['executed'] = $this->pdo->execute_pdo()->fetchAll();

		$mavueview = $this->load->view("sql_test");
		$mavueview->main();
	}
}
