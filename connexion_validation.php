<?php $active = 4;
$title = "Connexion";
require('header.php'); 
$page = $_SERVER['PHP_SELF'];

$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] :  "";

$password = isset($_POST['password']) ? $_POST['password'] :  "";

//Si pseudo sup à 8 carac.
if (strlen($pseudo) >= 0) {
    //Si mdp sup à 8 carac.
    if (strlen($password) >= 0) {
        //On rentre la requête sql dans une variable
        $sql = "SELECT * FROM utilisateur WHERE pseudo=:pseudo";
        //Lecture du pseudo dans la BDD 
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':pseudo' => $pseudo
            ));
            $user = $sth->fetch(PDO::FETCH_ASSOC);
        } //Gestion des erreurs
        catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }
        print_r($user);
        //Si pseudo et mdp correct alors connecté password_verify compare le mdp saisi avec le mdp crypté dans la BDD
        if ($pseudo === $user['pseudo'] && password_verify($password, $user['mdp'])) {
            //détruit la variable mdp
            unset($user["mdp"]);

            $_SESSION['user'] = $user;
            $_SESSION['messages'] = array(
                "connexion" => ["green", "Vous vous êtes bien connecté"]
            );
            //Redirige vers l'accueil si connexion réussie
            echo('<script>');
            echo('window.location.href = "index.php";');
          echo('</script>');
            //Conditions où la connexion échoue
        } else { // Message d'erreur lorsque les identifiants sont incorrects
            $_SESSION['messages'] = array("Account" => ["red", "Ces identifiants sont incorrects"]);
            echo('<script>');
            echo('window.location.href = "connexion.php";');
          echo('</script>');
        }
    } else { // Message d'erreur lorsque le mdp est incorrect
        $_SESSION['messages'] = array("Password" => ["red", "Vous avez rentré un mot de passe incorrect"]);
        echo('<script>');
        echo('window.location.href = "connexion.php";');
      echo('</script>');
    }
}

 