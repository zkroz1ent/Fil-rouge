
<?php require 'header.php';




//Détruit la variable user
unset($_SESSION['user']);
$_SESSION['messages'] = array(
    "deconnexion" => ["blue", "Vous vous êtes bien déconnecté"]
);
//Redirige vers l'accueil après la déconnexion
header("Location: index.php");








require 'footer.php';  ?>