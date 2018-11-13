<?php

class v_login extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'login/login';
		$this->linear_render();
	}
}
