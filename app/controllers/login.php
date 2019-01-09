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
		$this->core->success("Loggued", "login", "main");
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
		$this->core->set_view("login", "change_password");
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
