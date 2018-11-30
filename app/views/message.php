<?php

class v_message extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'message';
		$this->css_files[] = 'message';
		$this->layout_render();
	}
}
