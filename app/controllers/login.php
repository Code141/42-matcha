<?php

class c_login extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->set_view("home", "main");
	}
	
	public function check($params = NULL)
	{
		$this->module_loader->session();
		if ($this->module_loader->session()->controller->is_loggued())
			$this->core->fail("You are already loggued", 'home', 'main');
		
		$fields = array( "username", "password");
		$fields = $this->requiered_fields($fields, $_POST);
		if ($fields === NULL)
			$this->core->fail("All fields are required", 'login', 'main');
		try {
			$this->module->session->login($fields);
		} catch (Exception $e) {
			$this->core->fail($e->getMessage(), "login", "main");
		}
		$this->core->success("Welcome to your account page", "account", "main");
	}

	public function logout($params = NULL)
	{
		$this->module_loader->session();
		$this->module->session->logout();
		$this->core->set_view("home", "main");
	}
	
	public function forgot_password($params = NULL)
	{
		$this->core->set_view("login", "forgot_password");
	}
	
	public function change_password($params = NULL)
	{
		if (empty($params[0]) || empty ($params[1]))
			$this->core->fail("Error while attempt to changing password", 'home', 'main');
		$this->data['email'] = $params[0];
		$this->data['token'] = $params[1];
		$this->core->set_view("login", "change_password");
	}

	public function reset($params = NULL)
	{

		$fields = array("email", "token", "password", "password_repeat");
		$fields = $this->requiered_fields($fields, $_POST);
		if ($fields == NULL)
			$this->core->fail("Error while attempt to changing password", 'home', 'main');

		if (!$this->load->model("account")->check_pass_token($_POST['email'], $_POST['token']))
			$this->core->fail("Bad token", 'home', 'main');
		$this->module_loader->session();
		try
		{
			$this->module->session->check_password($_POST['password'], $_POST['password_repeat']);
		}
		catch (Exception $e)
		{
			$this->core->fail($e->getMessage(), "login", "forgot_password");
		}

		$encrypted = $this->module->session->hash_password($_POST['password']);
		$this->load->model("account")->change_pass($_POST['email'], $encrypted);

		$this->core->success("Password changed", 'home', 'main');
	}

	public function reset_password($params = NULL)
	{
		$this->module_loader->session();
		$fields = array("username");
		$fields = $this->requiered_fields($fields, $_POST);

		if ($fields === NULL)
			$this->core->fail("All fields are required", 'login', 'forgot_password');
		try {
			$this->module->session->reset_password($fields['username']);
		} catch (Exception $e) {
			$this->core->fail($e->getMessage(), "login", "forgot_password");
		}
		$this->core->success("Reset password has be sent to your email", "login", "main");
	}
}
