<?php include "header.php" ?>
<?php 
$id_util = $_SESSION['user']['id_utilisateur'];
$sql = 'SELECT id_adherent FROM adherent WHERE id_utilisateur=:id_util';
try{
	$sel = $dbh->prepare($sql);
	$sel->execute(array(
		':id_util' => $id_util
	));
}catch (PDOException $ex) {
	die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$id_adherent = $sel->fetch(PDO::FETCH_COLUMN);

$sql2 = 'SELECT num FROM information_banquaire WHERE id_adherent=:id_adherent';
try{
	$sel = $dbh->prepare($sql2);
	$sel->execute(array(
		':id_adherent' => $id_adherent
	));
}catch (PDOException $ex) {
	die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$num_banquaire = $sel->fetch(PDO::FETCH_COLUMN);

$sql2 = 'SELECT * FROM adherent WHERE id_adherent=:id_adherent';
try{
	$sel = $dbh->prepare($sql2);
	$sel->execute(array(
		':id_adherent' => $id_adherent
	));
}catch (PDOException $ex) {
	die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$adherent = $sel->fetch(PDO::FETCH_ASSOC);
?>

<body>
    <h3>Bonjour <?= $_SESSION['user']['pseudo']; ?></h3>
    <div class="paniertab">
    <table>
        <tr><th>Nom</th><th>Prénom</th><th>Pseudo</th><th>Mail</th><th>Numéro de carte</th><th>Adresse</th><th>Modifier infos</th></tr>
        <tr>
            <td><?= $_SESSION['user']['nom']; ?></td>
            <td><?= $_SESSION['user']['prenom']; ?></td>
            <td><?= $_SESSION['user']['pseudo']; ?></td>
            <td><?= $_SESSION['user']['mail']; ?></td>
            <td><?= $num_banquaire; ?></td>
            <td>
                <?=$adherent['adresse1'];?><br>
                <?=$adherent['adresse2'];?><br>
                <?=$adherent['adresse3'];?><br>
                <?=$adherent['Pays'];?>
            </td>
            <td><form method="post" action="">
            <input type="hidden" name="mdp" value="">
            <input type="submit" name="edit_mdp" value="Modifier"></td>
        </tr>
    </table>
    </div>
</body>

<?php
include "footer.php" 

?>