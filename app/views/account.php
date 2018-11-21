<?php

class v_account extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'account';
		$this->layout_render();
	}
}
