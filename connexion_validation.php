<?php $active = 4;
$title = "Connexion";
require('header.php');
require('sql.php');
$page = $_SERVER['PHP_SELF'];

$nom = isset($_POST['nom']) ? $_POST['nom'] :  "";

$password = isset($_POST['password']) ? $_POST['password'] :  "";
logToDisk($page, $nom, $password);
//Si nom sup à 8 carac.
if (strlen($nom) >= 0) {
    //Si mdp sup à 8 carac.
    if (strlen($password) >= 0) {
        //On rentre la requête sql dans une variable
        $sql = "SELECT * FROM utilisateur WHERE nom=:nom";
        //Lecture du nom dans la BDD 
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':nom' => $nom
            ));
            $user = $sth->fetch(PDO::FETCH_ASSOC);
        } //Gestion des erreurs
        catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }
        //Si nom et mdp correct alors connecté password_verify compare le mdp saisi avec le mdp crypté dans la BDD
        if ($nom === $user['nom'] && password_verify($password, $user['mdp'])) {
            //détruit la variable mdp
            unset($user["mdp"]);

            $_SESSION['user'] = $user;
            $_SESSION['messages'] = array(
                "connexion" => ["green", "Vous vous êtes bien connecté"]
            );
            //Redirige vers l'accueil si connexion réussie
            header("Location: index.php");
            //Conditions où la connexion échoue
        } else { // Message d'erreur lorsque les identifiants sont incorrects
            $_SESSION['messages'] = array("Account" => ["red", "Ces identifiants sont incorrects"]);
            header("Location: connexion.php");
        }
    } else { // Message d'erreur lorsque le mdp est incorrect
        $_SESSION['messages'] = array("Password" => ["red", "Vous avez rentré un mot de passe incorrect"]);
        header("Location: connexion.php");
    }
}
if ($utilisateur == 1) {
    $sql = "SELECT ";
}
