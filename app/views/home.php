<?php

class v_home extends v_view
{
	public function main($params = NULL)
	{

		$this->html_files[] = 'home';
		$this->regular_render();
	}
}
