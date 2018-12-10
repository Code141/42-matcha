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

	public function	show_history()
	{
		$user = $this->modules->session->controller->user_loggued();

		$history = $this->self->model->get_history($user['id']);
		return ($history);
	}
}

