<?php
define('_DIR_ROOT', __DIR__);
// Xu ly http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTP'] == 'on') {
	$web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
	$web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(str_replace("\\","/",_DIR_ROOT)));
$web_root = $web_root . $folder;
define("_WEB_ROOT", $web_root);



require_once 'configs/routes.php';
require_once 'configs/database.php';
require_once 'core/Route.php';
require_once 'app/App.php';
require_once 'core/Connection.php';
$db_config = $config['database'];
require_once 'core/Database.php';
$db = new Database();

require_once 'core/BaseModel.php';
require_once 'core/BaseController.php';