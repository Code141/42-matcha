<?php


class c_session extends c_controller
{
	public function __construct()
	{
		$this->error = 'Login :';
	}

	public function	login(string $username, string $password)
	{
		try
		{
			$encrypted_password = $this->hash_password($password);
		//	$user = $this->load->model('login', 'get_user_by_username', $this->data);
$user = 3;

			if ($user == NULL)
				throw new Exception("Unknow user");
			if ($encrypted_password != $user['password'])
				throw new Exception("Bad password");
			if ($user['validated_account'] != "TRUE")
				throw new Exception("Account not validated");

		}
		catch (Exception $e)
		{
			throw $e;
			return (FALSE);
		}


		$password_length = strlen($password);


		$_SESSION['user'] = array();
		$_SESSION['user']['id'] = "3";
		$_SESSION['user']['email'] = "email@email.fr";
		$_SESSION['user']['password_length'] = 8;
		$_SESSION['user']['username'] = $fields['username'];
		return (TRUE);
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
		if ($this->is_loggued())
			return ($_SESSION['user']['username']);
		return (NULL);
	}

	public function	loggued_id()
	{
		if (is_loggued())
			return ($_SESSION['user']['id']);
		return (NULL);
	}

	private function	check_password($password, $passwordbis)
	{
		$password_len = strlen($password);
		if ($password != $passwordbis)
			return ("Password and retyped password doesn't match");
		if ($password_len < 8)
			return ("Password too short");
		if ($password_len > 50)
			return ("Password too long");
		if (!preg_match('/[A-Z]/', $password)
			|| !preg_match('/[a-z]/', $password)
			|| !preg_match('/[0-9]/', $password)
			|| !preg_match('/@|!|\.|,|-|_/', $password))
			return ('Password too easy. It must contain uppercase, lowercase, number, and special charactere like ( @ ! - _ , . )');
		return (TRUE);
	}

	private function	hash_password($password)
	{
		$hash = hash('whirlpool', $password);
		// password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
		// bool password_verify ( string $password , string $hash )
		return ($hash);
	}

	private function	check_email($email)
	{
		if (empty($email))
			return ("Empty email");
		if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE)
			return ("Invalid email");
		$load = new Loader();
		$data['email'] = $email;
		$nb = $load->model('register', 'count_user_by_email', $data);
		if ($nb !== 0)
			return ('Email taken');
		return (TRUE);
	}

	private function	check_username($username)
	{
		if (strlen($username) < 3)
			return ('Username too short');
		if (strlen($username) > 30)
			return ('Username too long');
		if (!preg_match("/^[a-zA-Z0-9_\-\.]+$/", $username))
			return ('Username characters can be min, maj, number, underscore, dash, or dot, noting else');
		$load = new Loader();
		$data['username'] = $username;
		$nb = $load->model('register', 'count_user_by_username', $data);
		if ($nb !== 0)
			return ('Username taken');
		return (TRUE);
	}

}


