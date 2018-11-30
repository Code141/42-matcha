<?php

class c_profil extends c_controller
{
	public function main($params = NULL)
	{
		$user = $this->module_loader->session()->controller->user_loggued();
		if ($params)
			$this->data['profil'] = $this->load->model("profil")
				->create_profil($params[0], $user['id']);
		else
			$this->data['profil'] = $user;
		$this->core->set_view("profil", "main");
	}
}
