<?php

class c_account extends c_logged_only
{
	public function main($params = NULL)
	{
		$model = $this->load->model("account");
		$this->data['all_tags'] = $model->fetch_all_from("tag");
		$this->data['all_genders'] = $model->fetch_all_from("gender");
		$this->data['all_gender_id'] = $model->fetch_all_from("gender_identity");
		$ip = $this->getUserIp();
		$this->json['ip_location'] = file_get_contents("http://ipinfo.io/{$ip}/json");
		$this->json['user'] = json_encode($_SESSION['user']);
		$this->core->set_view("account", "main");
	}

	function getUserIP()
	{
		// Get real visitor IP behind CloudFlare network
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
		{
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];
		if (filter_var($client, FILTER_VALIDATE_IP))
			$ip = $client;
		else if (filter_var($forward, FILTER_VALIDATE_IP))
			$ip = $forward;
		else
			$ip = $remote;
		if ($ip == "::1" || $ip = "127.0.0.1")
			$ip = file_get_contents("http://ipecho.net/plain");
		return $ip;
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

/*
	private function update_session($username, $pw_len)
	{
		$module = $this->module_loader->session();
		$user = $module->model->get_user_by_login($username);

		$user['orientations'] = $module->model->get_user_orientations($user['id']);
		$user['tags'] = $module->model->get_user_tags($user['id']);
		$user['bio'] = $module->model->get_bio($user['id']);
		$user['media'] = $module->model->get_user_media($user['id']);
		$_SESSION['user'] = $user;
		$_SESSION['user']['password_length'] = $pw_len;
	}
*/

	public function edit_user()
	{
		$successmsg = "";
		$user = $_SESSION['user'];
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
			$module = $this->module_loader->session()->controller;
			if (!empty($_POST['password']) || !empty($_POST['password2']))
			{
				$module->check_password($_POST['password'], $_POST['password2']);
				$fields['password'] = $module->hash_password($_POST['password']);
				$successmsg .= "Password has successfully been updated<br>";
			}
			if ($user['username'] !== $_POST['username'])
				$module->check_username($_POST['username']);
			if ($user['birthdate'] !== $_POST['birthdate'])
				$module->check_date($_POST['birthdate']);
			if ($user['email'] !== $_POST['new_email'])
			{
				echo "holaaaa";
				$module->check_email($_POST['new_email']);
				$fields['new_email'] = $_POST['new_email'];
				$fields['token_email'] = $module->unique_id();	
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
		$module->update_session();
		$_SESSION['user']['password_length'] = $pw_len;
		$this->core->success("Your profil has successfully been updated<br>" . $successmsg, 'account', 'main');
	}	

	public function edit_bio()
	{
		if (!isset($_POST['bio']) || trim($_POST['bio']) == "")
			$this->core->fail("Your bio can not be empty", 'account', 'main');
		$model = $this->load->model("account");
		$model->edit_bio($_SESSION['user']['id'], $_POST['bio']);
		$this->module_loader->session()->controller->update_session();
		$this->core->success("Bio added successfully", 'account', 'main');
	}

	public function edit_location()
	{
		if (!is_ajax_query())
			$this->core->fail("There was a problem with location input", 'account', 'main');
		else 
		{
			if (isset($_POST['lat']) && isset($_POST['lng']) &&
				$_POST['lat'] != "" && $_POST['lng'] != "")	
			{
				$user = $_SESSION['user'];
				if ($_POST['lat'] == $user['latitude'] && $_POST['lng'] == $user['longitude'])
				{
					$json_reponse['fail'] = "Nothing to update";
					echo json_encode($json_reponse); 
					return;
				}
				$model = $this->load->model("account");
				$model->edit_location($user['id'], $_POST['lat'], $_POST['lng']);
				$this->module_loader->session()->controller->update_session();
				$json_reponse['success'] = "Location has been successfully updated";
				echo json_encode($json_reponse); 
			}
			else
			{
				$json_reponse['fail'] = "There was a problem with location input";
				echo json_encode($json_reponse); 			
			}
		}
	}

	public function del_preference()
	{
		$model = $this->load->model("account");
		$model->del_preference($_SESSION['user']['id'], $_POST['gender'], $_POST['gender_identity']);
		$this->module_loader->session()->controller->update_session();
		$this->core->success("Preference successfully deleted", 'account', 'main');
	}

	public function add_preference()
	{
		if (empty($_POST['gender']) || empty($_POST['gender_identity']) ||
			((!is_numeric($_POST['gender']) || $_POST['gender'] > 4) && $_POST['gender'] != 'NULL') ||
			(!is_numeric($_POST['gender_identity']) && $_POST['gender_identity'] != 'NULL'))
			$this->core->fail("Bad/wrong input for this field", 'account', 'main');
		$user = $_SESSION['user'];
		$model = $this->load->model("account");
		if (!$model->add_preference($user['id'], $_POST['gender'], $_POST['gender_identity']))
			$this->core->fail("No preference to add", 'account', 'main');
		$this->module_loader->session()->controller->update_session();
		$this->core->success("Matching preference successfully added", 'account', 'main');
	}

	public function del_tag()
	{
		if (!isset($_POST['tag']) || !is_numeric($_POST['tag']))
			$this->core->fail("No tag specified", 'account', 'main');
		$user = $_SESSION['user'];
		$model = $this->load->model("account");
		$model->del_tag($user['id'], $_POST['tag']);
		$this->module_loader->session()->controller->update_session();
		$this->core->success("Tag successfully deleted", 'account', 'main');
	}

	public function add_tag()
	{
		if (!isset($_POST['tag']) || $_POST['tag'] == "")
			$this->core->fail("Tag must contain at least one character", 'account', 'main');
		$tag_name = preg_replace("/^\s*#*\s*/", "", $_POST['tag']);
		$tag_name = rtrim($tag_name);
		if ($tag_name == "")
			$this->core->fail("Tag is badly formated", 'account', 'main');
		$user = $_SESSION['user'];
		$model = $this->load->model("account");
		if (!$model->add_tag($user['id'], $tag_name))
			$this->core->fail("No tag to add", 'account', 'main');
		$this->module_loader->session()->controller->update_session();
		$this->core->success("Tag successfully added", 'account', 'main');
	}

	public function change_email($params = NULL)
	{
		$model = $this->load->model("account");
		if (count($params) !== 2 || !$model->change_email($params[0],$params[1]))
			$this->core->fail("There was a probleme validating your new email. Please login and make a new request", 'login', 'main');
		$this->core->success("Your email has been succesfully changed", 'login', 'main');
	}
}
