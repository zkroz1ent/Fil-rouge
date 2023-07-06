<?php $active = 4;
$title = "Connexion";
require('header.php'); 
$page = $_SERVER['PHP_SELF'];

$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] :  "";

$password = isset($_POST['password']) ? $_POST['password'] :  "";

if (strlen($pseudo) >= 0) {
    if (strlen($password) >= 0) {
        $sql = "SELECT * FROM utilisateur WHERE pseudo=:pseudo";
        
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':pseudo' => $pseudo
            ));
            $user = $sth->fetch(PDO::FETCH_ASSOC);
        }
        catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }
   
        
        if ($pseudo === $user['pseudo'] && password_verify($password, $user['mdp'])) {
            
            unset($user["mdp"]);
            $_SESSION['panier']=array();
            $_SESSION['user'] = $user;
            $_SESSION['messages'] = array(
                "connexion" => ["green", "Vous vous êtes bien connecté"]
            );
            
            echo('<script>');
            echo('window.location.href = "index.php";');
          echo('</script>');
            
        } else {
            $_SESSION['messages'] = array("Account" => ["red", "Ces identifiants sont incorrects"]);
            echo('<script>');
            echo('window.location.href = "connexion.php";');
          echo('</script>');
        }
    } else {
        $_SESSION['messages'] = array("Password" => ["red", "Vous avez rentré un mot de passe incorrect"]);
        echo('<script>');
        echo('window.location.href = "connexion.php";');
      echo('</script>');
    }
}

 