<?php

class v_matches extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'sql_test';
		$this->layout_render();
	}
}
