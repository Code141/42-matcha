<?php

class v_dashboard extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'dashboard';
		$this->css_files[] = 'dashboard';
		$this->layout_render();
	}
}
