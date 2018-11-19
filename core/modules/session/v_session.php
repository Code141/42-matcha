<?php

class v_module_session extends v_module_view
{
	public function login($params = NULL)
	{
		if ($this->self->controller->is_loggued())
			$this->load_html('loggued');
		else
			$this->load_html('login');
	}

	public function loggued($params = NULL)
	{
		if ($this->self->controller->is_loggued())
			$this->load_html('loggued');
		else
			$this->load_html('login');
	}


	public function register($params = NULL)
	{
		$this->load_html('register');
	}
}
