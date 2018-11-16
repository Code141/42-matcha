<?php

class c_session extends c_controller
{
	public function __construct()
	{
		$_SESSION = NULL;
		$_SESSION['user'] = "toto";
	}

	public function	login(string $username = NULL, string $password = NULL)
	{
		$fields = array( "username", "password");
		$fields = $this->core->requiered_fields($fields, $_POST);
		if ($field === NULL)
			$this->core->fail("All fields are required", "login", "main");
/*
		$this->data['username'] = stripslashes($_POST['username']);
		$this->data['encrypted_password'] = $this->hash_password($_POST['password']);

		$this->data['user'] = $this->load->model('login', 'get_user_by_username', $this->data);
		if ($this->data['user'] == NULL)
			$this->fail("Unknow user", "main", "login");
		if ($this->data['encrypted_password'] != $this->data['user']['password'])
			$this->fail("Bad password", "main", "login");
		if ($this->data['user']['validated_account'] != "TRUE")
			$this->fail("Account not validated", "main", "login");
		$this->data['user']['password_length'] = strlen($_POST['password']);
		login($this->data['user']);
		$this->success("Loggued");


		$_SESSION['user']['id'] = $user['id'];
		$_SESSION['user']['email'] = $user['email'];
		$_SESSION['user']['password_length'] = $user['password_length'];
		$_SESSION['user']['username'] = $user['username'];
		$_SESSION['user']['n_like'] = $user['notif_like'];
		$_SESSION['user']['n_comment'] = $user['notif_comment'];
		$_SESSION['user']['n_message'] = $user['notif_message'];

		return (TRUE);
 */
	}

	public function	logout()
	{
		$_SESSION = NULL;
		session_destroy();
	}

	public function	is_loggued()
	{
		if (!isset($_SESSION['user']))
			return (FALSE);
		else
			return (TRUE);
	}

	public function	loggued_username()
	{
		if (is_loggued())
			return ($_SESSION['user']['username']);
		return (NULL);
	}

	public function	loggued_id()
	{
		if (is_loggued())
			return ($_SESSION['user']['id']);
		return (NULL);
	}
}


