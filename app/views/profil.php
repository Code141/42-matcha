<?php

class v_profil extends v_view
{
	public function main($params = NULL)
	{
		$this->html_files[] = 'profil';
		$this->css_files[] = 'profil';
		$this->layout_render();
	}
}
