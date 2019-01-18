<?php

class c_profil extends c_logged_only
{
	private function check_full_profil($user)
	{
		$minimum_required = array(
			"username",
			"firstname",
			"lastname",
			"birthdate",
			"id_media",
			"password",
			"email",
			"id_gender",
			"id_gender_identity",
			"latitude",
			"longitude",
			"tags",
			"bio");

		foreach($minimum_required as $field)
			if ($user[$field] == NULL)
				$this->core->fail("Please complete your profil before looking for matches", "account", "main");
	}

	public function main($params = NULL)
	{
		$user = $this->module_loader->session()->controller->user_loggued();
		$this->check_full_profil($user);
		if ($params)
		{
			if ($params[0] == $user['id'])
				$this->core->success("","account", "main");
			$this->data['profil'] = $this->load->model("profil")->create_profil($params[0], $user['id']);
			if ($this->data['profil'] == NULL)
				$this->core->fail("blocked user", "matches", "main");
			else
				if ($user['id'] != $params[0])
				{
					$this->load->model("history")->add($user['id'], $params[0]);
					$this->module_loader->websocket()->controller->send_visit($params[0]);
				}
		}
		else
			$this->data['profil'] = $user;

		$this->core->set_view("profil", "main");
	}
}
