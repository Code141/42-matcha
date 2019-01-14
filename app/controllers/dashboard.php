<?php

class c_dashboard extends c_logged_only
{
	public function main($params = NULL)
	{
		$user = $this->module_loader->session()->controller->user_loggued();
		$this->data['blocked'] = $this->load->model("dashboard")->get_blocked($user['id']);
		$this->data['matches'] = $this->load->model("dashboard")->get_matched($user['id']);
		$this->data['likes'] = $this->load->model("dashboard")->get_likers($user['id']);
		$this->core->set_view("dashboard", "main");
	}
}
