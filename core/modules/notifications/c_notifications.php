<?php

class c_module_notifications extends c_controller
{
	private function	tag_notif($array, $str)
	{
		foreach ($array as $key => $value)
			$array[$key]['notif_msg'] = $str;
		return ($array);
	}

	public function		get_notifications()
	{
		$user = $this->modules->session->controller->user_loggued();
		$history = $this->self->model->get_history($user['id']);
		$like = $this->self->model->get_like($user['id']);
		$revoke = $this->self->model->revoke($user['id']);
		$like = $this->tag_notif($like, "has liked you");
		foreach ($like as $key => $value)
			if ($like[$key]['matche'])
				$like[$key]['notif_msg'] = "has matched you";
		$revoke = $this->tag_notif($revoke, "has revoked you");
		$history = $this->tag_notif($history, "has visited your profile");
		$notif = array_merge($history, $like, $revoke);
		usort($notif, function ($a, $b) {
			return strtotime($b["timestamp"]) - strtotime($a["timestamp"]);
		});
		return ($notif);
	}

	public function		get_historique()
	{
		$user = $this->modules->session->controller->user_loggued();
		$history = $this->self->model->get_history($user['id']);
		$notif = $this->tag_notif($history, "has visited your profile");
		usort($notif, function ($a, $b) {
			return strtotime($b["timestamp"]) - strtotime($a["timestamp"]);
		});
		return ($notif);
	}

	public function		get_like()
	{
		$user = $this->modules->session->controller->user_loggued();
		$like = $this->self->model->get_like($user['id']);
		$revoke = $this->self->model->revoke($user['id']);
		$like = $this->tag_notif($like, "has liked you");
		foreach ($like as $key => $value)
			if ($like[$key]['matche'])
				$like[$key]['notif_msg'] = "has matched you";
		$revoke = $this->tag_notif($revoke, "has revoked you");
		$notif = array_merge($like, $revoke);
		usort($notif, function ($a, $b) {
			return strtotime($b["timestamp"]) - strtotime($a["timestamp"]);
		});
		return ($notif);
	}

}

