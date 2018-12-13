<?php

class c_profil extends c_controller
{
	public function main($params = NULL)
	{
		$user = $this->module_loader->session()->controller->user_loggued();
		if ($params)
		{
			$this->data['profil'] = $this->load->model("profil")->create_profil($params[0], $user['id']);
			if ($this->data['profil'] == NULL)
				$this->core->fail("Unknow user", "404");
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
