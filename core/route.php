<?php

function	parse_uri(string $uri) : array
{
	$pattern = "~^" . SITE_ROOT . "~";
	$uri = preg_replace($pattern, "", $uri);
	$uri = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $uri);
	$uri = strtok($uri, '?');
	$uri = trim($uri, '/');
	$exploded_uri = explode('/', $uri);
	$request['controller'] = ($exploded_uri[0] != '') ? $exploded_uri[0] : DEFAULT_CONTROLLER;
	$request['action'] = (isset($exploded_uri[1])) ? $exploded_uri[1] : DEFAUT_ACTION;
	$request['params'] = (isset($exploded_uri[2])) ? array_slice($exploded_uri, 2) : NULL;
	return ($request);
}


