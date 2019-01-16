<?php

class c_dashboard extends c_logged_only
{
	public function main($params = NULL)
	{
		$user = $_SESSION['user'];
		$this->data['blocked'] = $this->load->model("dashboard")->get_blocked($user['id']);
		$this->data['matches'] = $this->load->model("dashboard")->get_matched($user['id']);
		$this->data['likes'] = $this->load->model("dashboard")->likes($user['id']);
		$this->data['liked_by'] = $this->load->model("dashboard")->liked_by($user['id']);
		$this->core->set_view("dashboard", "main");
	}
}
