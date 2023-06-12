<?php include "header.php" ?>

<?php 
$id_adherent = isset($_GET['id_adherent']) ? $_GET['id_adherent'] : "";
$id_utilisateur = $_SESSION['user']['id_utilisateur'];
$sql = "SELECT * FROM adherent WHERE id_adherent=:id_adherent";
try{
	$sel = $dbh->prepare($sql);
	$sel->execute(array(
		':id_adherent' => $id_adherent
	));
}catch (PDOException $ex) {
	die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$adherent = $sel->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT * FROM utilisateur WHERE id_utilisateur=:id_utilisateur";
try{
	$sel = $dbh->prepare($sql2);
	$sel->execute(array(
		':id_utilisateur' => $id_utilisateur
	));
}catch (PDOException $ex) {
	die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$utilisateur = $sel->fetch(PDO::FETCH_ASSOC);
?>
<body>
<div class="center">
    <h1>S'inscrire</h1>
    <form class="form" action="editaccount.php?id_adherent=<?=$id_adherent?>" method="post">
        <table>
            <tr>
                <td><label for="nom">Nom : </label></td>
                <td><input type="text" id="nom" name="nom" value="<?php echo $utilisateur['nom']; ?>"></td>
            </tr>
            <tr>
                <td><label for="prenom">Prénom : </label></td>
                <td><input type="text" id="prenom" name="prenom" value="<?php echo $utilisateur['prenom']; ?>"></td>
            </tr>
            <tr>
                <td><label for="pseudo">Pseudo :<br> au moins 8 char : </label></td>
                <td><input type="text" id="pseudo" name="pseudo" value="<?php echo $utilisateur['pseudo']; ?>"></td>
            </tr>
            <tr>
                <td><label for="mail">Email : </label></td>
                <td><input type="text" id="mail" name="mail" value="<?php echo $utilisateur['mail']; ?>"></td>
            </tr>       
            <tr>
                <td><label for="num_telephone">num_telephone : </label></td>
                <td><input type="text" id="num_telephone" name="num_telephone" value="<?php echo $adherent['num_telephone']; ?>"></td>
            </tr>
            </tr>
            <tr>
                <td><label for="adresse1">Adresse : </label></td>
                <td><input type="text" id="adresse1" name="adresse1" value="<?php echo $adherent['adresse1']; ?>"></td>
            </tr>
            <tr>
                <td><label for="adresse2">Complément adresse : </label></td>
                <td><input type="text" id="adresse2" name="adresse2" value="<?php echo $adherent['adresse2']; ?>"></td>
            </tr>
            <tr>
                <td><label for="adresse3">Code postal : </label></td>
                <td><input type="text" id="adresse3" name="adresse3" value="<?php echo $adherent['adresse3']; ?>"></td>
            </tr>
            <tr>
                <td><label for="adresse4">Ville : </label></td>
                <td><input type="text" id="adresse4" name="adresse4" value="<?php echo $adherent['adresse4']; ?>"></td>
            </tr>
            <tr>
                <td><label for="pays">Pays : </label></td>
                <td><input type="text" id="pays" name="pays" value="<?php echo $adherent['Pays'] ?>"></td>
            </tr>
            <td>
                <p><a href="connexion.php">Terminé ?</a></p>
                </body>
            </td>
            <td><input class="button green full" name="submit" type="submit" value="Modifier"></td>
            </tr>
        </table>
    </form>
</div>

<?php
$pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] :  '';
$mail = isset($_POST['mail']) ? $_POST['mail'] :  '';
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : '';
$adresse1 = isset($_POST['adresse1']) ? $_POST['adresse1'] : '';
$adresse2 = isset($_POST['adresse2']) ? $_POST['adresse2'] : '';
$adresse3 = isset($_POST['adresse3']) ? $_POST['adresse3'] : '';
$adresse4 = isset($_POST['adresse4']) ? $_POST['adresse4'] : '';
$num_telephone = isset($_POST['num_telephone']) ? $_POST['num_telephone'] : '';
$pays = isset($_POST['pays']) ? $_POST['pays'] : '';
$submit = isset($_POST['submit']);
//Si l'user a cliqué sur submit
if ($submit) {
    try {        //insertion de l'utilsateur   
        $req = $dbh->prepare('UPDATE utilisateur SET nom=:nom, prenom=:prenom, mail=:mail, pseudo=:pseudo WHERE id_utilisateur=:id_utilisateur');
        $req->execute(array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':mail' =>   $mail,
            ':pseudo' => $pseudo,
            ':id_utilisateur' => $id_utilisateur
        ));
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    try {  // modification de l'adhérent
        $req = $dbh->prepare('UPDATE adherent SET adresse1=:adresse1, adresse2=:adresse2, adresse3=:adresse3, adresse4=:adresse4, Pays=:pays, num_telephone=:num_telephone WHERE id_adherent=:id_adherent');
        $req->execute(array(
            ':adresse1' => $adresse1,
            ':adresse2' => $adresse2,
            ':adresse3' => $adresse3,
            ':adresse4' => $adresse4,
            ':pays' => $pays,
            ':num_telephone' => $num_telephone,
            ':id_adherent' => $id_adherent
        ));
        //  echo 'enregistrement effectué !';
        // header('Location:connexion.php');
    } catch (PDOException $ex) { //gestion des erreurs
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
    echo('<script>');
    echo('window.location.href = "settings.php";');
    echo('</script>');
}

?>

</body>
<?php
include "footer.php" 
?>