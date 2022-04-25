<?php 

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('SITE_ROOT', DS . 'opt' . DS . 'lampp' . DS . 'htdocs' . DS . 'Gallery');

// define('SITE_ROOT', DS . 'Users' . DS . 'apple' . DS . '.bitnami' . DS . 'stackman' . DS . 'machines'  . DS . 'xampp' . DS . 'volumes' . DS . 'root' . DS . 'htdocs' . DS . 'Gallery');
// /Users/apple/.bitnami/stackman/machines/xampp/volumes/root/htdocs/Gallery

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once(INCLUDES_PATH.DS."functions.php");
require_once(INCLUDES_PATH.DS."config.php");
require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(INCLUDES_PATH.DS."photo.php");
require_once(INCLUDES_PATH.DS."comment.php");
require_once(INCLUDES_PATH.DS."session.php");



?>