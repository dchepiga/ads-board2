<?php
if (file_exists('gfun.php')) {
    include_once 'gfun.php';
}//help function

ini_set('display_errors', 1);

define("ROOT_PATH", dirname(__FILE__));
require 'vendor/autoload.php';

require_once ROOT_PATH . '/framework/core/FrontController.php';

