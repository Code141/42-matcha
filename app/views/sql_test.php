<?php

class v_sql_test extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'sql_test';
		$this->css_files[] = 'sql_test';
		$this->linear_render();
	}
}
