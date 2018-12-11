<?php

class c_module_notifications extends c_controller
{
/*
	L’utilisateur a reçu un “like”.
	Un utilisateur “liké” a “liké” en retour.

	L’utilisateur a reçu une visite.
	L’utilisateur a reçu un message.
	Un utilisateur matché ne vous “like” plus.

 */

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


		$like = $this->tag_notif($like, "has liked you");
		$history = $this->tag_notif($history, "has visited your profile");

		$notif = array_merge($history, $like);
		usort($notif, function ($a, $b) {
			return strtotime($b["timestamp"]) - strtotime($a["timestamp"]);
		});
		return ($notif);
	}
}

