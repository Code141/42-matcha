<?php

class c_module_session extends c_controller
{
	public function	login($fields)
	{
		$encrypted_password = $this->hash_password($fields['password']);
		$user = $this->self->model->get_user_by_login($fields['username']);
		try
		{
			if ($user == NULL)
				throw new Exception("Unknow user");
			if ($encrypted_password !== $user['password'])
				throw new Exception("Bad password");
			if ($user['token_account'] != NULL)
				throw new Exception("Account not validated");
		}
		catch (Exception $e)
		{
			throw $e;
			return (FALSE);
		}
		$_SESSION['user'] = $user;
		$_SESSION['user']['password_len'] = strlen($fields['password']);
		return (TRUE);
	}

	public function	logout()
	{
		$_SESSION['user'] = NULL;
		unset($_SESSION['user']);
		session_destroy();
	}

	public function	is_loggued()
	{
		if (!isset($_SESSION['user']))
			return (FALSE);
		else
			return (TRUE);
	}

	public function	user_loggued()
	{
		if ($this->is_loggued())
			return ($_SESSION['user']);
		return (NULL);
	}

	public function	check_register($fields)
	{
		$encrypted_password = $this->hash_password($fields['password']);
		try
		{
			$id_gender = intval($fields["id_gender"]);
			if (!$this->self->model->is_valid_id_gender($id_gender))
				throw new Exception("Invalid gender");
			$this->check_email ($fields['email']);
			$this->check_password ($fields['password'], $fields['password_repeat']);
			$this->check_username ($fields['username']);
		}
		catch (Exception $e)
		{
			throw $e;
			return (FALSE);
		}
		$fields['encrypted_password'] = $encrypted_password;
		$fields['token_account'] = $token = $this->unique_id();
		$this->self->model->new_user($fields);
		$this->modules->email();
		$this->modules->email->controller->to($fields['email'])->sing_up($fields['token_account']);
		return (TRUE);
	}

	public function	hash_password($password)
	{
		$hash = hash('whirlpool', $password);
		// password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
		// bool password_verify ( string $password , string $hash )
		return ($hash);
	}

	public function unique_id()
	{
		return implode('', [
			bin2hex(random_bytes(4)),
			bin2hex(random_bytes(2)),
			bin2hex(chr((ord(random_bytes(1)) & 0x0F) | 0x40)) . bin2hex(random_bytes(1)),
			bin2hex(chr((ord(random_bytes(1)) & 0x3F) | 0x80)) . bin2hex(random_bytes(1)),
			bin2hex(random_bytes(6))
		]);
	}

	private function	check_password($password, $password_repeat)
	{
		try
		{
			if ($password != $password_repeat)
				throw new Exception("Password and retyped password doesn't match");
			$password_len = strlen($password);
			if ($password_len < 8)
				throw new Exception("Password too short");
			if ($password_len > 50)
				throw new Exception("Password too long");
			if (!preg_match('/[A-Z]/', $password)
				|| !preg_match('/[a-z]/', $password)
				|| !preg_match('/[0-9]/', $password)
				|| !preg_match('/@|!|\.|,|-|_/', $password))
				throw new Exception('Password too easy. It must contain uppercase, lowercase, number, and special charactere like ( @ ! - _ , . )');
		}
		catch (Exception $e)
		{
			throw $e;
			return (FALSE);
		}
		return (TRUE);
	}

	private function	check_email($email)
	{
		try
		{
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE)
				throw new Exception("Invalid email");
			if ($this->self->model->is_taken_mail($email))
				throw new Exception('Email taken');
		} catch (Exception $e) {
			throw $e;
			return (FALSE);
		}
		return (TRUE);
	}

	public function	reset_password($username)
	{
		try
		{
			$token = $this->unique_id();
			if (!$this->self->model->reset_password($username, $token))
				throw new Exception("Unknow username");
			$user = $this->self->model->get_user_by_login($username);
			$this->modules->email()->controller->to($user['email'])->reset_password($token);
		} catch (Exception $e) {
			throw $e;
			return (FALSE);
		}
		return (TRUE);
	}

	public function	validate_email($email, $token)
	{
		try
		{
			$user = $this->self->model->get_user_by_email($email);
			if ($user == NULL)
				throw new Exception('Unknow email');
			if ($user['token_account'] != $token)
				throw new Exception('Invalid token');
			$this->self->model->reset_token_account($email);
		} catch (Exception $e) {
			throw $e;
			return (FALSE);
		}
		return (TRUE);
	}

	private function	check_username($username)
	{
		try
		{
			if (strlen($username) < 3)
				throw new Exception('Username too short');
			if (strlen($username) > 30)
				throw new Exception('Username too long');
			if (!preg_match("/^[a-zA-Z0-9_\-\.]+$/", $username))
				throw new Exception('Username characters can be min, maj, number, underscore, dash, or dot, noting else');
			if ($this->self->model->get_user_by_login($username))
				throw new Exception("Username already taken");
		}
		catch (Exception $e)
		{
			throw $e;
			return (FALSE);
		}
		return (TRUE);
	}
}


