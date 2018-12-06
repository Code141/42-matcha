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

	private function update_session($user, $pw_len)
	{
		$module = $this->module_loader->session();
		$user = $module->model->get_user_by_login($user['username']);

		$user['orientations'] = $module->model->get_user_orientations($user['id']);
		$user['tags'] = $module->model->get_user_tags($user['id']);
		$user['bio'] = $module->model->get_bio($user['id']);
		$_SESSION['user'] = $user;
		$_SESSION['user']['password_length'] = $pw_len;
	}

	public function edit_user()
	{
		$user = $this->module_loader->session()->controller->user_loggued();
		$fields = array("username", "firstname", "lastname", "email");
		$fields = $this->requiered_fields($fields, $_POST);
		if ($fields === NULL)
			$this->core->fail("Please fill in required fields", 'account', 'main');
			try 
			{
				if (!empty($_POST['password']) || !empty($_POST['password2']))
				{
					$this->module->session->check_password($_POST['password'], $_POST['password2']);
					$encrypted_password = $this->module->session->hash_password($_POST['password']);
					$fields['password'] = $encrypted_password;
				}
				if ($user['username'] !== $_POST['username'])
					$this->module->session->check_username($_POST['username']);
				if ($user['birthdate'] !== $_POST['birthdate'])
					$this->module->session->check_date($_POST['birthdate']);
				if ($user['email'] !== $_POST['email'])
				{
					$this->module->session->check_email($_POST['email']);
					$email_token = $this->module->session->unique_id();
					$fields['new_email'] = $_POST['email'];
				}
			}
			catch (Exception $e)
			{
				$this->core->fail($e->getMessage(), "account", "main");
			}
			$fields['email'] = $user['email'];
			$model = $this->load->model("account");
			$model->update_user($user['id'], $fields);
			$this->update_session($fields, $user['password_length']);
			/*
			 * add success log of email for pw and email validation
			 */
			$this->core->success("Your profil has successfully been updated", 'account', 'main');
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
}
