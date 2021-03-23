<?php if(!defined('BASEPATH')) exit("Access Denied");
//definitions definitions
define('FACEBOOK_SDK_V4_SRC_DIR', dirname(__FILE__));
//require the autoloader
require_once 'autoload.php';
require_once 'facade/CIFacebookPersistentDataHandler.php';
//empty class to  trick ci into loading file
class Fblib{public function __construct(){}}