<?php require 'header.php';
unset($_SESSION['user']);
$_SESSION['messages'] = array(
    "deconnexion" => ["blue", "Vous vous êtes bien déconnecté"]
);
header("Location: index.php");
require 'footer.php';  ?>