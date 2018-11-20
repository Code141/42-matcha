<?php

class v_login extends v_view
{
	public function forgot_password()
	{
		$this->html_files[] = 'forgot_password';
		$this->layout_render();
	}

	public function change_password()
	{
		$this->html_files[] = 'change_password';
		$this->layout_render();
	}
}
