<?php
$active = 1;
$title = "Accueil";
include 'function/function.php';
require('header.php');
require('sql.php');
echo '<br>';
//recupération des données
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$submit = isset($_POST['submit']);
$id_utilisateur = isset($_POST['id_utilisateur']) ? $_POST['id_utilisateur'] : '';
$message = " ";
if ($submit) {
    $sql = "select * from utilisateur where pseudo=:pseudo and mail=:mail";
    try {
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
            'pseudo' => $pseudo,
            'mail' => $email
        ));
        $utilisateur = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) { //erreur SQL
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    if ($pseudo == $utilisateur["pseudo"] && ($utilisateur["mail"])) { //condition et verification de l'adresse mail et speudo
        $id_utilisateur = $utilisateur["id_utilisateur"];

        MailToDisk(
            $email,
            $pseudo,
            "votre nouveau mot de passe est :",
            $utilisateur["id_utilisateur"]
        );
        // Affiche la liste des mails
        $files = array_diff(scandir(dirname(__FILE__)), array('.', '..', "index.php"));
        echo "<ul>";
        foreach ($files as $file) {
            echo "<li>" . $file . "</li>";
        }
    }
    $message = "Pseudo ou email invalide";
}
// Envoie le mail
echo "</ul>";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mot_de_passe_oublié</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <h3>Mot de passe oublié</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="pseudo">Pseudo</label><br>
        <input type="text" name="pseudo" />
        <br><br>
        <label for="mdp">adresse mail</label><br>
        <input type="text" name="email" />
        <br><br>
        <input type="submit" name="submit" value="valider"> &nbsp;&nbsp;
    </form>
    <br>
    <?php
    echo "$message"; //message d'erreur SQL
    $active = 1;
    $title = "mot de passe oublié";
    require('footer.php');
    ?>
    </div>

</body>

</html>