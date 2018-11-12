<?php

class entity_user
{
	public $id = NULL;
	public $username = NULL;
	public $email = NULL;
	private $password = NULL;
	private $password_length = NULL;
	public $notif = array(
		'like' => NULL,
		'comment' => NULL,
		'message' => NULL
	);
	public $validated_account = NULL;

	public function	__construct($id_user)
	{
		$this->load = new loader();
		$data['id_user'] = $id_user;
		$user = $this->load->model("user", "get_user_by_id", $data);
		if ($user === NULL)
			return (NULL);
		$this->standar_load($user);
		return ($this);
	}

	private function	standar_load($user)
	{
		$this->username = $user['username'];
		$this->email = $user['email'];
		$this->notif['like'] = $user['notif_like'];
		$this->notif['comment'] = $user['notif_comment'];
		$this->notif['message'] = $user['notif_message'];
		$this->validated_account = $user['validated_account'];
		$this->reset_password = $user['reset_password'];
		
	}
}
