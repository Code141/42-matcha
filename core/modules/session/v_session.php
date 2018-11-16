<?php

class v_session extends v_view
{
	public function main($params = NULL)
	{
		if ($this->module->is_loggued())
			$this->load_html('login/login');
		else
			$this->load_html('login/login');
	}
}
