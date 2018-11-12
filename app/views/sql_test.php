<?php

class v_sql_test extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'sql_test';
		$this->data['data_view'] = "this data is setted into a view";
	$this->data[] = 'HEHE';
		$this->linear_render();
	}
}
