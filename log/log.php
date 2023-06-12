<?php
function logToDisk($page,$pseudo,$password)
{
// Horodatage
$date = new DateTime('now',new DateTimeZone('Europe/Paris'));
$laDate = $date->format("Y-m-d H:i:s.u");
$root = dirname(__FILE__); // Dossier courant
$message = $laDate . ";" . $_SERVER['REMOTE_ADDR'] . ";" . $page . ";".";pseudo=".$pseudo.";password=".$password.";".PHP_EOL;
//$message = $laDate .";".get_ip().";".$page.PHP_EOL;
$filename = $root . DIRECTORY_SEPARATOR . 'log.txt';
file_put_contents($filename, $message, FILE_APPEND);
}
/**
* Retourne l'adresse IP du client
*
* @return void
*/
function get_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}





?>