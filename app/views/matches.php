<?php

class v_matches extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'matches';
		$this->css_files[] = 'matches';
		$this->layout_render();
	}
}
