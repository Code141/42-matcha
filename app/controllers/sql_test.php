<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{

		$this->data['data_controller'] = "this data is setted into a controller";
		$columns = array ("*");
		$this->data['sql'] = $this->pdo->select(array("*"),"user")->where(array("id"), array("1"));
		$this->data['executed'] = $this->pdo->execute_pdo()->fetchAll();


		$mavueview = $this->load->view("sql_test");
		$mavueview->main();
	}
}
