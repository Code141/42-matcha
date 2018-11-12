<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{

		$this->data['data_controller'] = "this data is setted into a controller";
		$this->data[] = 'HOHO';

		$this->data['match'] = $this->pdo
			->select('user')
			->where("match", '>5')
 			->limit (100, 10);
   





		$mavueview = $this->load->view("sql_test");
		$mavueview->main();
	}
}
