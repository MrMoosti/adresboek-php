<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);


//C:\xampp\htdocs\adresboek-php\siteroot
defined('SITE_ROOT') ? null:
    define('SITE_ROOT', 'C:' .DS. 'xampp7' .DS. 'htdocs' .DS. 'adresboek-php' .DS. 'siteroot');

defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// Load config file first
require_once(LIB_PATH.DS.'Config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'Functions.php');

// Load core objects
require_once(LIB_PATH.DS.'Session.php');
require_once(LIB_PATH.DS.'Database.php');
require_once(LIB_PATH.DS.'DatabaseObject.php');

// load database-related classes
require_once(LIB_PATH.DS.'User.php');
require_once(LIB_PATH.DS.'Contactpersoon.php');


?>
