<?php

class c_ajax extends c_controller
{
	public function like($params)
	{
		$response = Array ();
		$user = $this->module_loader->session()->controller->user_loggued();
		$id_user_to = intval($params[0]);
		$response['row'] = $this->load->model("interactions")->like($user["id"], $id_user_to);
		$response['status'] = "success";

		$this->module_loader->websocket()->controller->send_like($id_user_to);

		if (!is_ajax_query())
			$this->core->success("You liked it !", "matches", "main");
		else
			echo json_encode($response);
	}
}

