<?php

class c_ajax extends c_logged_only
{
	public function like($params)
	{
		$response = Array ();
		$response['status'] = "fail";
		if (empty($params[0]))
			if (!is_ajax_query())
				$this->core->success("Bad user selected", "dashboard", "main");
			else
				die (json_encode($response));
		$user = $this->module_loader->session()->controller->user_loggued();
		$id_user_to = intval($params[0]);
		$response['row'] = $this->load->model("interactions")->like($user["id"], $id_user_to);
		$response['status'] = "success";
		if ($this->load->model("interactions")->does_match($user["id"], $id_user_to))
		{
			if (!$this->load->model("message")->find_conv($user["id"], $id_user_to))
				$this->load->model("message")->crea_conv($user["id"], $id_user_to);
			$this->module_loader->websocket()->controller->send_matche($id_user_to);
		}
		else
			$this->module_loader->websocket()->controller->send_like($id_user_to);

		if (!is_ajax_query())
			$this->core->success("You liked it !", "dashboard", "main");
		else
			echo json_encode($response);
	}

	public function dislike($params)
	{
		$response = Array ();
		$response['status'] = "fail";
		if (empty($params[0]))
			if (!is_ajax_query())
				$this->core->success("Bad user selected", "dashboard", "main");
			else
				die (json_encode($response));
		$user = $this->module_loader->session()->controller->user_loggued();
		$id_user_to = intval($params[0]);
		$this->load->model("interactions")->dislike($user["id"], $id_user_to);
		$response['status'] = "success";

		$this->module_loader->websocket()->controller->send_dislike($id_user_to);
		if (!is_ajax_query())
			$this->core->success("You disliked it !", "dashboard", "main");
		else
			echo json_encode($response);
	}

	public function see_notifs()
	{
		$user = $this->module_loader->session()->controller->user_loggued();
		$this->load->model("interactions")->see_notifs($user["id"]);
	}

	public function block($params)
	{
		$response = Array ();
		$response['status'] = "fail";
		if (empty($params[0]))
			if (!is_ajax_query())
				$this->core->success("Bad user selected", "dashboard", "main");
			else
				die (json_encode($response));
		$user = $this->module_loader->session()->controller->user_loggued();
		$id_user_to = intval($params[0]);

		$this->load->model("interactions")->dislike($user["id"], $id_user_to);

		$response['row'] = $this->load->model("interactions")->block($user["id"], $id_user_to);
		if ($response['row'])
			$this->module_loader->websocket()->controller->send_block($id_user_to);
		$response['status'] = "success";

		if (!is_ajax_query())
			$this->core->success("You bloked this user !", "dashboard", "main");
		else
			echo json_encode($response);
	}

	public function unblock($params)
	{
		$response = Array ();
		$response['status'] = "fail";
		if (empty($params[0]))
			if (!is_ajax_query())
				$this->core->success("Bad user selected", "dashboard", "main");
			else
				die (json_encode($response));
		$user = $this->module_loader->session()->controller->user_loggued();
		$id_user_to = intval($params[0]);
		$response['row'] = $this->load->model("interactions")->unblock($user["id"], $id_user_to);
		$response['status'] = "success";
		if (!is_ajax_query())
			$this->core->success("You unbloked this user !", "dashboard", "main");
		else
			echo json_encode($response);
	
	}

	public function report($params)
	{
		$response = Array ();
		$response['status'] = "fail";
		if (empty($params[0]))
			if (!is_ajax_query())
				$this->core->success("Bad user selected", "dashboard", "main");
			else
				die (json_encode($response));
		$user = $this->module_loader->session()->controller->user_loggued();
		$id_user_to = intval($params[0]);

		$response['row'] = $this->load->model("interactions")->report($user["id"], $id_user_to);
		$response['status'] = "success";
		if (!is_ajax_query())
			$this->core->success("You reported this user !", "dashboard", "main");
		else
			echo json_encode($response);
	}
}

