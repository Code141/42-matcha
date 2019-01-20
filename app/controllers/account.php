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
				$successmsg .= "Password has successfully been updated";
			}
			if ($user['username'] !== $_POST['username'])
				$module->check_username($_POST['username']);
			if ($user['birthdate'] !== $_POST['birthdate'])
				$module->check_date($_POST['birthdate']);
			if ($user['email'] !== $_POST['new_email'])
			{
				$module->check_email($_POST['new_email']);
				$fields['new_email'] = $_POST['new_email'];
				$fields['token_email'] = $module->unique_id();	
				$mail = $this->module_loader->email();
				$mail->controller->to($fields['new_email'])->change_email($fields['token_email']);
				$successmsg .= "An email has been sent to " . $_POST['new_email'] . " to validate your new email";
			}
		}
		catch (Exception $e)
		{
			$this->core->fail($e->getMessage(), "account", "main");
		}
		$model = $this->load->model("account");

		if (!empty($_POST['id_gender_identity']))
		{
			if (!($fields['id_gender_identity'] = $model->fetch_and_add_gender_id($_POST['id_gender_identity'])))
				$this->core->fail('gender identity must contain at least one character', "account", "main");
		}
		else
			unset($fields['id_gender_identity']);

		$model->update_user($user['id'], $fields);
		$pw_len = isset($fields['password']) ? strlen($_POST['password']) : $user['password_length'];
		$module->update_session();
		$_SESSION['user']['password_length'] = $pw_len;
		$this->core->success("Your profil has successfully been updated " . $successmsg, 'account', 'main');
	}	

	public function edit_bio()
	{
		if (!isset($_POST['bio']) || trim($_POST['bio']) == "")
			$this->core->fail("Your bio can not be empty", 'account', 'main');
		if (strlen($_POST['bio']) >= 2000)
			$this->core->fail("Your bio is too long (2000 char max)", 'account', 'main');
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
		if (strlen($tag_name) >= 64)
			$this->core->fail("Tag is too long", 'account', 'main');
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
		if (count($params) !== 2)
			$this->core->fail("Bad request", 'login', 'main');
		if (!$model->change_email($params[0], $params[1]))
			$this->core->fail("There was a probleme validating your new email. Please login and make a new request", 'login', 'main');

		$module = $this->module_loader->session()->controller;
		$module->update_session();
		$this->core->success("Your email has been succesfully changed", 'login', 'main');
	}

	private function check_file()
	{
		if (empty($_FILES["fileToUpload"]["tmp_name"]))
			return "No file chosen";
		if ($_FILES["fileToUpload"]["size"] > 10000000)
			return ("File is too large");
		if(isset($_POST["submit"])){
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check === false) 
				return("File is not an image");
		}
		$allowed_types = array ('image/jpeg', 'image/png');
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$ext = array_search($finfo->file($_FILES["fileToUpload"]['tmp_name']), $allowed_types, true);
		if (false === $ext)
			return ("File is badly formatted");
		return NULL;
	}

	private function format_file($photo,$media_path)
	{
		$photo_array = explode('/', $photo);
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		if ($finfo->file($photo) === 'image/jpeg'){
			$jpeg_photo = imagecreatefromjpeg($photo);
			unlink($photo);
			$end = preg_replace('/(\.jpg$)|(\.jpeg$)/', '.png', end($photo_array));
			$photo =  $media_path.$end;
			imagepng($jpeg_photo,$photo);
			imagedestroy($jpeg_photo);
		}
		$src = imagecreatefrompng($photo);
		$maxDim = 250;
		list($width, $height, $type, $attr) = getimagesize($photo);
		$new_width = $width;
		$new_height = $height;
		if ($width > $maxDim || $height > $maxDim) {
			$target_filename = $photo;
			$ratio = $width/$height;
			if( $ratio > 1) {
				$new_width = $maxDim;
				$new_height = $maxDim/$ratio;
			} else {
				$new_width = $maxDim*$ratio;
				$new_height = $maxDim;
			}
		}
		$dst = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagedestroy($src);
		return ($dst);
	}

	public function upload_file()
	{
		if (count($_SESSION['user']['media']) == 5)
		{
			if (is_ajax_query())
				exit("You can have maximum 5 pictures");
			$this->core->fail("You can have maximum 5 pictures", 'account', 'main');
		}	
		if (($err = $this->check_file()))
		{
			if (is_ajax_query())
				exit($err);
			$this->core->fail($err, 'account', 'main');
		}
		$media_path = APP_PATH . 'assets/media/';
		if(!is_dir($media_path))
			mkdir($media_path);

		$model = $this->load->model("account");
		$media_id = $model->add_media($_SESSION['user']['id']);
		$finalpath = $media_path . $media_id . '.png';
		if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $finalpath))
		{
			if (is_ajax_query())
				exit("There was an error uploading file");
			$this->core->fail("There was an error uploading file", 'account', 'main');
		}
		$photo = $finalpath;
		$dst = $this->format_file($finalpath, $media_path);
		$ret = imagepng( $dst, $finalpath);
		imagedestroy( $dst );
		$this->module_loader->session()->controller->update_session();
		if (is_ajax_query())
		{ 
			if($ret)
				exit("Image upload success!/" . $media_id);
			exit("Image upload fail...");
		}
		if ($ret)
			$this->core->success('Image upload success!', 'account', 'main');
		$this->core->fail('Image upload fail...', 'account', 'main');
	}

	public function delete_img()
	{
		if (is_ajax_query())
		{
			if (!isset($_POST['id_media']) || empty($_POST['id_media']) || !is_numeric($_POST['id_media']))
				exit('Sorry, an error occured');
			foreach($_SESSION['user']['media'] as $key => $media)
			{
				if (intval($media['id_media']) == intval($_POST['id_media']))
				{
					$model = $this->load->model("account");
					$model->delete_media($_POST['id_media'], $_SESSION['user']['id']);
					$path = APP_PATH . 'assets/media/' . $_POST['id_media'] . '.png';
					unlink($path);
					unset($_SESSION['user']['media'][$key]);
					$this->module_loader->session()->controller->update_session();
					exit(NULL);
				}
			}
			exit("This image doesn't belong to you");
		}
		$this->core->fail('An error occured', 'account', 'main');
	}

	public function set_as_profil_pic()
	{
		if (is_ajax_query())
		{
			if (!isset($_POST['id_media']) || empty($_POST['id_media']) || !is_numeric($_POST['id_media']))
				exit('Sorry, an error occured');
			foreach($_SESSION['user']['media'] as $media)
			{
				if ($media['id_media'] == $_POST['id_media'])
				{
					$model = $this->load->model("account");
					$model->set_as_profil_pic($_POST['id_media'], $_SESSION['user']['id']);
					$this->module_loader->session()->controller->update_session();
					exit(NULL);
				}
			}
			exit("This image doesn't belong to you");
		}
		$this->core->fail('An error occured', 'account', 'main');
	}
}
