<?php

function	is_ajax_query()
{
	if (isset($_GET['is_ajax']))
		return ((intval($_GET['is_ajax'])) ? TRUE : FALSE);
	else
		return (FALSE);
}

function	is_loggued()
{
	if (!isset($_SESSION['user']))
		return (FALSE);
	else
		return (TRUE);
}

function	loggued_username()
{
	if (is_loggued())
		return ($_SESSION['user']['username']);
	return (NULL);
}

function	loggued_id()
{
	if (is_loggued())
		return ($_SESSION['user']['id']);
	return (NULL);
}

function	human_date($str)
{
	$timestamp = strtotime($str);
	$date = localtime($timestamp, true);
	$now = localtime(time(), true);

	if ($date["tm_year"] != $now["tm_year"])
		return date("M Y", $timestamp);
	else if ($date["tm_mon"] != $now["tm_mon"])
		return date("j M", $timestamp);
	else if ($date["tm_mday"] != $now["tm_mday"])
		return date("D j", $timestamp);
	else
		return date("G:i", $timestamp);
}

function	redirect($path = "")
{
	header ('location:'.SITE_ROOT. $path);
	die();
}

function	redirect_on_last ()
{

	if (!isset($_SESSION['last_url']))
		redirect ();
	$params = "";
	if (isset($_SESSION['last_url']['params']))
		$params = implode('/', $_SESSION['last_url']['params']);
			redirect ($_SESSION['last_url']['controller']
			. '/' .
			$_SESSION['last_url']['action']
			. '/' .
			$params
		);
}
