<?php

class v_module_websocket extends v_module_view
{
	public function chat($params = NULL)
	{
		if ($this->modules->session()->controller->is_loggued())
			$this->load_html('chat');
		else
			echo "NON LOGGUED PAS DE CHAT";
	}
}
