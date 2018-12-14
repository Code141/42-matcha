<?php

class c_ajax extends c_controller
{
	public function like($params)
	{
		$response = Array ();
		$response['status'] = "fail";
		if (empty($params[0]))
		{
			if (!is_ajax_query())
				$this->core->success("Bad user selected", "matches", "main");
			else
				echo json_encode($response);
		}
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

	public function dislike($params)
	{
		$response = Array ();
		$response['status'] = "fail";
		if (empty($params[0]))
		{
			if (!is_ajax_query())
				$this->core->success("Bad user selected", "matches", "main");
			else
				echo json_encode($response);
		}
		$user = $this->module_loader->session()->controller->user_loggued();
		$id_user_to = intval($params[0]);
		$this->load->model("interactions")->dislike($user["id"], $id_user_to);
		$response['status'] = "success";

		$this->module_loader->websocket()->controller->send_dislike($id_user_to);
		if (!is_ajax_query())
			$this->core->success("You disliked it !", "matches", "main");
		else
			echo json_encode($response);
	}
	
	public function see_notifs()
	{
		$user = $this->module_loader->session()->controller->user_loggued();
		$this->load->model("interactions")->see_notifs($user["id"]);
	}
}

