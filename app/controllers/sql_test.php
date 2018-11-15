<?php

class c_sql_test extends c_controller
{
	public function main($params = NULL)
	{
		$model = $this->load->model("sql_test");
		$this->data['executed'] = $model->matches();
		$this->core->set_view("sql_test", "main");
	}
}
