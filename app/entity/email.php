<?php

class entity_email
{
	public $from = "gelambin@e3r6p7.42.fr";
	public $user_to = NULL;
	public $user_from = NULL;
	public $subject = NULL;
	public $message = NULL;
	public $header = NULL;
	public $status = NULL;

	public function	__construct(entity_user $user_to)
	{
		$this->load = new loader();
		$this->user_to = $user_to;
	}

	public function send_mail()
	{
		$this->set_header();
		$this->subject = "[Camagru] " . $this->subject;
		$this->status = mail($this->user_to->email, $this->subject, $this->message, $this->header);
	}

	private function set_header()
	{
		$this->headers = 'From: ' . $this->from . '\r\n' .
			'Reply-To: ' . $this->from . '\r\n' .
			'X-Mailer: PHP/' . phpversion();
	}

	public function	sing_up($token)
	{
		$this->subject = 'Signup';
		$this->message = "Welcome " . $this->user_to->username . "\r\n
			Thanks for signing up in Camagru!\r\n
			Now you just have to click this link to activate your account:\r\n
			"  . SITE_ABSOLUTE . "register/validate_email/" . $this->user_to->email . "/" . $token;
		$this->send_mail();
	}

	public function	reset_password($token)
	{
		$this->subject = 'Reset password';
		$this->message = "Hi " . $this->user_to->username . "\r\n
			You hasked to reset your password\r\n
			Here is a link to reset your password:\r\n
			"  . SITE_ABSOLUTE . "login/change_password/" . $this->user_to->email . "/" . $token;
		$this->send_mail();
	}

	public function	notif_like($user_from, $media, $grade)
	{
		if (!$this->user_to->notif['like'])
			return;
		$this->subject = 'Somewhome has liked your picture';
		$this->message = $user_from->username . " have liked your picture\r\n"
			. SITE_ABSOLUTE . "gallery/focus/" . $media['id'];
		$this->send_mail();
	}

	public function	notif_comment($user_from, $media, $comment)
	{
		if (!$this->user_to->notif['comment'])
			return;
		$this->subject = 'You have new comment';
		$this->message = $user_from->username . " have comment your picture\r\n"
			. "Comment : \"" . $comment . "\"\r\n"
			. SITE_ABSOLUTE . "gallery/focus/" . $media['id'];
		$this->send_mail();
	}
}
