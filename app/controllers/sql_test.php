<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$this->model = new m_model($this->pdo);
		$this->data['sql'] = $this->model
			->select(array("*"),"user")
			->where("id", "=" ,"1")
;//			->and("username", "=", "fiofy");
		echo($this->model->sql. "<br>");
		$this->data['executed'] = $this->pdo->execute_pdo()->fetchAll();
/*		
		$this->data['sql'] = 
			$this->pdo
			->select(array("firstname"),"user")
			->left_join("");
 */		$this->core->set_view("sql_test", "main");
	}
}
