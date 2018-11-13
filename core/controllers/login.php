<?php

class c_login extends c_public_only
{
	public function main($params = null)
	{
		$this->data['title'] = "login";
		$this->files['css'][] = 'login';
		$this->files['views']['center'] = 'login/login';

		$mavueview = $this->load->view("login");
		$mavueview->main();
	}

	public function checklogin($params = null)
	{
		$this->load->script('php', 'login');
		$register_fields = array(
			"username",
			"password"
		);
		foreach ($register_fields as $field)
			if (!isset($_POST[$field]) || empty($_POST[$field]))
				$this->fail($field . " field is unset", "main", "login");
		$this->data['username'] = stripslashes($_POST['username']);
		$this->data['encrypted_password'] = hash_password($_POST['password']);
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
	}

	public function forgotten_password($params = null)
	{
		$this->data['title'] = 'Forgotten password';
		$this->files['css'][] = 'login';
		$this->files['views']['center'] = 'login/forgotten_password';
		$this->render();
	}

	public function reset_password($params = null)
	{
		if (empty($_POST['email']))
			$this->fail("You must set email", "forgotten_password", "login");
		$this->data['email'] = $_POST['email'];
		$this->data['user'] = $this->load->model('user', 'get_user_by_email', $this->data);
		if ($this->data['user'] === NULL)
			$this->fail("Unknow user", "forgotten_password", "login");
		$this->data['user']['id_user'] = $this->data['user']['id'];
		$this->data['user']['token'] = hash('whirlpool', uniqid());
		$this->load->model('user', 'set_reset_password_token', $this->data['user']);
		$user_to = new entity_user($this->data["user"]['id']);
		if ($user_to === NULL)
			$this->fail("User don't existe.");
		$mail = new entity_email($user_to);
		$mail->reset_password($this->data['user']['token']);
		$this->success("Reinitialisation mail has be sent", "main", "login");
	}

	public function change_password($params = null)
	{
		if (empty($params[0]) || empty($params[1]))
			$this->fail("You must set email and token", "main", "login");
		$this->data['email'] = $params[0];
		$this->data['token'] = $params[1];
		$this->data['user'] = $this->load->model('user', 'get_user_by_email', $this->data);
		if ($this->data['user']['reset_password'] !== $this->data['token'])
			$this->fail("Bad token", "main", "login");
		$this->data['title'] = 'Reset password';
		$this->files['css'][] = 'login';
		$this->files['views']['center'] = 'login/reset_password';
		$this->render();
	}

	public function	update_password($params = NULL)
	{
		$this->load->script('php', 'login');
		$register_fields = array("email", "token", "password", "passwordbis");
		foreach ($register_fields as $field)
			if (!isset($_POST[$field]) || empty($_POST[$field]))
				$this->fail($field . " field is unset", "main", "login");
		$this->data['email'] = $_POST['email'];
		$this->data['password'] = $_POST['password'];
		$this->data['passwordbis'] = $_POST['passwordbis'];
		$this->data['token'] = $_POST['token'];
		$this->data['user'] = $this->load->model('user', 'get_user_by_email', $this->data);
		if ($this->data['user']['reset_password'] !== $this->data['token'])
			$this->fail("Bad token", "main", "login");
		if (($err = check_password($this->data['password'], $this->data['passwordbis'])) !== TRUE)
			$this->fail($err, "main", "login");
		$this->data['new_password'] = hash_password($this->data['password']);
		$this->data['id_user'] = $this->data['user']['id'];
		$this->load->model('settings', 'update_password', $this->data);
		$this->load->model('settings', 'delete_password_reset_hash', $this->data);
		$this->success("Password updated", "main", "login");
	}
}
