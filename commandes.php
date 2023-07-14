<?php include "header.php" ?>
<br><br>
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
$sql2 = "SELECT ID_commande, date, ROUND(SUM(prix_produit * nombre),2) AS prix_total FROM commande, produit
WHERE commande.id_produit = produit.id_produit 
AND commande.ID_commande = commande.ID_commande
AND commande.ID_adherent = :id_adherent GROUP BY commande.ID_commande;";
try{
    $sel = $dbh->prepare($sql2);
	$sel->execute(array(
		':id_adherent' => $id_adherent
	));
}catch (PDOException $ex) {
    die("Erreur lors de la requête SQL SELECT ligne : " . $ex->getMessage());
}
$commandes = $sel->fetchAll(PDO::FETCH_ASSOC);
$sql3 = "SELECT * FROM adherent
JOIN utilisateur on adherent.id_utilisateur= utilisateur.id_utilisateur
WHERE EXISTS ( SELECT * FROM commande WHERE commande.ID_adherent = adherent.ID_adherent); ";
try{
    $sel = $dbh->query($sql3);
}catch (PDOException $ex) {
    die("Erreur lors de la requête SQL SELECT ligne : " . $ex->getMessage());
}
$adherents = $sel->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <h1>Bonjour <?= $_SESSION['user']['pseudo']; ?></h1>
    <?php
    if (isset($_SESSION['user'])&&$_SESSION['user']['role'] == '0') {
        echo '<h3 style ="text-align: center;">Mes commandes</h3>';
        echo '<div class=paniertab>';
        echo '<table>';
        echo '<tr><th>Produit</th><th>Prix total<th>Date</th><th>Action</th></tr>';
        foreach ($commandes as $commande) {
            echo '<tr>';
            echo '<td>Commande n°' . $commande['ID_commande'] . '</td>';
            echo '<td>' . $commande['prix_total'] . '</td>';
            echo '<td>' . date('d/m/Y', strtotime($commande['date'])) . '</td>';
            echo '<td>';
            echo '<a href="detailcommande.php?id_commande='.$commande['ID_commande'].'">Voir détail</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div';
    }?>
        <?php
        if (isset($_SESSION['user'])&&$_SESSION['user']['role'] == '1') {
        echo '<h3>Les commandes</h3>';
        echo '<div class=paniertab>';
        echo '<table>';
        echo '<tr><th>ID</th><th>Nom</th><th>Prenom<th>Accès</th></tr>';
        foreach ($adherents as $adherent) {
        echo '<tr>';
        echo '<td>'.$adherent['id_adherent'].'</td>';
        echo '<td>'.$adherent['nom'].'</td>';
        echo '<td>'.$adherent['prenom'].'</td>';
        echo '<td><a href="commandesadmin.php?id='.$adherent['id_adherent'].'">Accèder</a></td>';
        echo '</tr>';
        }
        echo '</table>';
        echo '</div';
    }?>


</body>

<?php
include "footer.php";
?>