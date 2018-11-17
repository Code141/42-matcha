<?php

class v_session extends v_module_view
{
	public function main($params = NULL)
	{
		if ($this->self->controller->is_loggued())
			$this->load_html('login');
		else
			$this->load_html('login');
	}
}
