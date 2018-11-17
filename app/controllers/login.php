<?php

class c_login extends c_controller
{
	public function main($params = NULL)
	{
		$this->core->set_view("home", "main");
	}
	
	public function checklogin($params = NULL)
	{
		$this->module_loader->session();

		$fields = array( "username", "password");
		$fields = $this->requiered_fields($fields, $_POST);
		if ($fields === NULL)
			$this->core->fail("All fields are required", 'login', 'main');

		try {
			$this->module->session->login($fields['username'], $fields['password']);
		} catch (Exception $e) {
			$this->core->fail($e->getMessage(), "login", "main");
		}
		$this->core->success("Loggued !", "login", "main");


	}

	public function logout($params = NULL)
	{
		$this->module_loader->session();
		$this->module->session->logout();
		$this->core->set_view("home", "main");
	}

}
