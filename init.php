<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', '1');
ini_set('html_errors', '1');
ini_set('file_uploads', '1');
mb_internal_encoding('UTF-8');
date_default_timezone_set('Europe/Paris');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__)); 

include "function" . DS . "function.php";
?>

<?php
ini_set('display_errors', '1');
ini_set('html_errors', '1');
/**
 * Autoload
 * @param string $classe
 */
function my_autoloader($classe)
{
  include 'classes/' . $classe . '.php';
}

spl_autoload_register('my_autoloader');

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

require_once "fpdf/fpdf.php";
?>

