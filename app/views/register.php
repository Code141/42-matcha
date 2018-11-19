<?php

class v_register extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'register';
		$this->layout_render();
	}
}
