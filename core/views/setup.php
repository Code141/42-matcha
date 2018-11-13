<?php

class v_setup extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'setup';
		$this->data['data_view'] = "this data is setted into a view";
		$this->linear_render();
	}
}
