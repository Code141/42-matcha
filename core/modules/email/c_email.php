<?php

class c_module_email
{
	public $from = "gelambin@e3r6p7.42.fr";
	public $user_to = NULL;
	public $user_from = NULL;
	public $subject = NULL;
	public $message = NULL;
	public $header = NULL;
	public $status = NULL;

	public function to($user_to)
	{
		$this->user_to = $user_to;
		return ($this);
	}

	public function send_mail()
	{
		$this->set_header();
		$this->subject = "[" . APP_NAME . "] " . $this->subject;
		$this->status = mail($this->user_to, $this->subject, $this->message, $this->header);
	}

	private function set_header()
	{
		$this->headers = 'From: ' . $this->from . '\r\n' .
			'Reply-To: ' . $this->from . '\r\n' .
			'X-Mailer: PHP/' . phpversion();
	}

	public function	sing_up($token)
	{
		$link = "http://" . SITE_ABSOLUTE . "register/validate_email/" . $this->user_to . "/" . $token; 
		$this->subject = 'Signup';
		$this->message = "Welcome " . $this->user_to . "\r\n
Thanks for signing up in " . APP_NAME . " !\r\n
Now you just have to click this link to activate your account:\r\n" . $link;
		$this->send_mail();
	}

	public function	reset_password($token)
	{
		$link = "http://" . SITE_ABSOLUTE . "login/change_password/" . $this->user_to . "/" . $token; 
		$this->subject = 'Reset password';
		$this->message = "Hi " . $this->user_to . "\r\n
You hasked to reset your password\r\n
Here is a link to reset your password:\r\n" . $link;
		$this->send_mail();
	}

	public function	change_email($token)
	{
		$link = "http://" . SITE_ABSOLUTE . "account/change_email/" . $this->user_to . "/" . $token; 
		$this->subject = 'Validate your new e-mail';
		$this->message = "Hi " . $this->user_to . "\r\n
You hasked to change your e-mail\r\n
Here is a link to validate your new e-mail:\r\n" . $link;
		$this->send_mail();
	}

}

