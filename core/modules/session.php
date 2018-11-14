<?php

class module_session
{
	public function __construct()
	{
		$_SESSION['user'] = false;
		$_SESSION = NULL;
	}

	public function	is_loggued()
	{
		if (!isset($_SESSION['user']))
			return (FALSE);
		else
			return (TRUE);
	}

	public function	loggued_username()
	{
		if (is_loggued())
			return ($_SESSION['user']['username']);
		return (NULL);
	}

	public function	loggued_id()
	{
		if (is_loggued())
			return ($_SESSION['user']['id']);
		return (NULL);
	}
}


