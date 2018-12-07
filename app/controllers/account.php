<?php

class c_account extends c_controller
{
	public function main($params = NULL)
	{
		$model = $this->load->model("account");
		$this->data['all_tags'] = $model->fetch_all_from("tag");
		$this->data['all_genders'] = $model->fetch_all_from("gender");
		$this->data['all_gender_id'] = $model->fetch_all_from("gender_identity");
		$this->core->set_view("account", "main");
	}

	private function recursive_in_array($haystack, $needle)
	{
		if (is_array($haystack))
		{
			foreach ($haystack as $entry)
				if (is_array($entry) && in_array($needle, $entry))
				{
					$this->recursive_in_array($entry, $needle);
					return TRUE;
				}
		}
		return FALSE;
	}

	private function update_session($username, $pw_len)
	{
		$module = $this->module_loader->session();
		$user = $module->model->get_user_by_login($username);

		$user['orientations'] = $module->model->get_user_orientations($user['id']);
		$user['tags'] = $module->model->get_user_tags($user['id']);
		$user['bio'] = $module->model->get_bio($user['id']);
		$_SESSION['user'] = $user;
		$_SESSION['user']['password_length'] = $pw_len;
	}

	public function edit_user()
	{
		$successmsg = "";
		$user = $this->module_loader->session()->controller->user_loggued();
		$fields = array("username", "firstname", "lastname", "new_email");
		$fields = $this->requiered_fields($fields, $_POST);
		foreach ($_POST as $field => $value)
			$fields[$field] = $value;
		unset($fields['password']);
		unset($fields['password2']);
		unset($fields['new_email']);  
		if ($fields === NULL)
			$this->core->fail("Please fill in required fields", 'account', 'main');
		try 
		{
			if (!empty($_POST['password']) || !empty($_POST['password2']))
			{
				$this->module->session->check_password($_POST['password'], $_POST['password2']);
				$fields['password'] = $this->module->session->hash_password($_POST['password']);
				$successmsg .= "Password has successfully been updated<br>";
			}
			if ($user['username'] !== $_POST['username'])
				$this->module->session->check_username($_POST['username']);
			if ($user['birthdate'] !== $_POST['birthdate'])
				$this->module->session->check_date($_POST['birthdate']);
			if ($user['email'] !== $_POST['new_email'])
			{
				echo "holaaaa";
				$this->module->session->check_email($_POST['new_email']);
				$fields['new_email'] = $_POST['new_email'];
				$fields['token_email'] = $this->module->session->unique_id();	
				$mail = $this->module_loader->email();
				$mail->controller->to($fields['new_email'])->change_email($fields['token_email']);
				$successmsg .= "An email has been sent to " . $_POST['new_email'] . " to validate your new email<br>";
			}
		}
		catch (Exception $e)
		{
			$this->core->fail($e->getMessage(), "account", "main");
		}
		$model = $this->load->model("account");
		if (isset($_POST['id_gender_identity']))
			if (!($fields['id_gender_identity'] = $model->fetch_and_add_gender_id($_POST['id_gender_identity'])))
				$this->core->fail('gender identity must contain at least one character', "account", "main");
		$model->update_user($user['id'], $fields);
		$pw_len = isset($fields['password']) ? strlen($_POST['password']) : $user['password_length'];
		$this->update_session($fields['username'], $pw_len);
		$this->core->success("Your profil has successfully been updated<br>" . $successmsg, 'account', 'main');
	}	

	public function add_match_pref()
	{
		$model = $this->load->model("account");
		$all_genders = $model->fetch_all_from("gender");
		$all_gender_id = $model->fetch_all_from("gender_identity");

		$fields = array("username", "firstname", "lastname", "email", "password");
		$fields = $this->requiered_fields($fields, $_POST);
		if ($fields === NULL)
			$this->core->fail("Please fill in required fields", 'account', 'main');
		if (($_POST['gender'] !== 'NULL' && !$this->recursive_in_array($all_genders, $_POST['gender'])) ||
			($_POST['gender_identity'] !== 'NULL' && !$this->recursive_in_array($all_gender_id, $_POST['gender_identity'])))
			$this->core->fail("This orientation is not available (yet)", 'account', 'main');
		echo "ok";
		return TRUE;
	}

	public function change_email($params = NULL)
	{
		$model = $this->load->model("account");
		if (count($params) !== 2 || !$model->change_email($params[0],$params[1]))
			$this->core->fail("There was a probleme validating your new email. Please login and make a new request", 'login', 'main');
		$this->core->success("Your email has been succesfully changed", 'login', 'main');
	}
}
