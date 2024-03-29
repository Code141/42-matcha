<?php
session_start();

require_once('config/config.php');

if (!is_readable(CORE_PATH . 'core.php'))
	die ('The app don\'t seem to be correcty configured, please see /config/config.php');


require_once(CORE_PATH . 'core.php');

require_once(CORE_PATH . 'loader.php');
require_once(CORE_PATH . 'db.php');
require_once(CORE_PATH . 'wrapper.php');
require_once(CORE_PATH . 'view.php');
require_once(CORE_PATH . 'controller.php');

require_once(MODULES_PATH . 'modules.php');
require_once(MODULES_PATH . 'modules_view.php');

require_once(CORE_PATH . 'tool.php');

$core = new core();

$core->new_controller($core->request['controller']);
$core->execute_controller($core->request['action']);

