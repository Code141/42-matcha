<?php

class c_profil extends c_controller
{
	public function main($params = NULL)
	{
		$param = 1;
		$user = $this->module_loader->session()->controller->user_loggued();
		$this->req = $this->load->model("profil")
			->fetch_user($param, $user['id'])
				->execute()
			->fetchAll();

		$this->core->set_view("profil", "main");
	}
}
