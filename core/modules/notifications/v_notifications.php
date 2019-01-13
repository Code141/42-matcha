<?php

class v_module_notifications extends v_module_view
{
	public function show($params = NULL)
	{
		$this->load_html('notifications');
	}

	public function history($params = NULL)
	{
		$this->load_html('historique');
	}

	public function like($params = NULL)
	{
		$this->load_html('like');
	}
}
