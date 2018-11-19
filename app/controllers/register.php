<?php

class c_register extends c_controller
{
	public function	main()
	{
		$this->core->set_view("register", "main");
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


}
