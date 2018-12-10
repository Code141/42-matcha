<?php

class c_ajax extends c_controller
{
	public function like($params)
	{
		if (isset($_SERVER['HTTP_REFERER']))
		{
		}
		else
			$fields = array("controller" => "home", "action" => "main");

		if (empty($params[0]))
			$this->core->fail("Unknow user", $request['controller'], $request['action']);

		$id_user_to = intval($params[0]);

		$user = $this->module_loader->session()->controller->user_loggued();

//		$this->req = $this->load->model("interactions")->like($user["id"], $id_user_to);

		$this->core->success("You liked this user", "matches", "main");
	}
}
