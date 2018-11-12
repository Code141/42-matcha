<?php
session_start();

require_once('config/config.php');

if (!is_readable(CORE_PATH . 'route.php'))
	die ('The app don\'t seem to be correcty configured, please see /config/config.php');

require_once(CORE_PATH . 'route.php');

require_once(CORE_PATH . 'loader.php');

require_once(CORE_PATH . 'model.php');
require_once(CORE_PATH . 'view.php');
require_once(CORE_PATH . 'controller.php');

require_once(CORE_PATH . 'tool.php');


$request = parse_uri($_SERVER['REQUEST_URI']);

$load = new loader();

$loaded_controller = $load->controller($request['controller']);

$classes = preg_grep("/^(?!__).+/", get_class_methods($loaded_controller));
if (array_search($request['action'], $classes) === FALSE)
	$action = "error_404";
else
	$action = $request['action'];

$loaded_controller->$action($request['params']);

