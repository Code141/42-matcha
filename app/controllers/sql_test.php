<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$this->data['sql'] = $this->pdo
			->select(array("*"),"user")
			->where("id", "=" ,"1")
			->and("username", "=", "fiofy");
		echo($this->pdo->sql. "<br>");
		$this->data['executed'] = $this->pdo->execute_pdo()->fetchAll();
		$this->core->set_view("sql_test", "main");
	}
}
