<?php

class c_register extends c_public_only
{
	public function	main()
	{
		$this->core->set_view("home", "main");
	}
	
	public function check($params = NULL)
	{
		$this->module_loader->session();
		$fields = array(
			"email",
			"password",
			"password_repeat",
			"username",
			"firstname",
			"lastname",
			"id_gender",
			"birthdate");
		$fields = $this->requiered_fields($fields, $_POST);
		if ($fields === NULL)
			$this->core->fail("All fields are required", 'register', 'main');
		try {
			$this->module->session->check_register($fields);
		} catch (Exception $e) {
			$this->core->fail($e->getMessage(), "register", "main");
		}
		$this->core->success("Registered", "login", "main");
	}

	public function validate_email($params = NULL)
	{
		if (!isset($params[0]) || !isset($params[1]))
			$this->core->fail("All fields are required", 'login', 'main');
		$email = $params[0];
		$token = $params[1];
		$this->module_loader->session();
		try {
			$this->module->session->validate_email($email, $token);
		} catch (Exception $e) {
			$this->core->fail($e->getMessage(), "login", "main");
		}
		$this->core->success("Email validated", "login", "main");
	}
}
