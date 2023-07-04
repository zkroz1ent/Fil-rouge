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
$sql3 = "SELECT ID_commande, date, statut_commande, ROUND(SUM(prix_produit * nombre),2) AS prix_total FROM commande, produit
WHERE commande.id_produit = produit.id_produit 
AND commande.ID_commande = commande.ID_commande GROUP BY commande.ID_commande;";
try{
}catch (PDOException $ex) {
    die("Erreur lors de la requête SQL SELECT ligne : " . $ex->getMessage());
}
$commandes2 = $sel->fetchAll(PDO::FETCH_ASSOC); 
?>

<body>
    <h1>Bonjour <?= $_SESSION['user']['pseudo']; ?></h1>
    <h3>Mes commandes</h3>
    <?php
    if (isset($_SESSION['user'])&&$_SESSION['user']['role'] == '0') {
        echo '<div class=paniertab>';
        echo '<table>';
        echo '<tr><th>Produit</th><th>Prix total<th>Date</th><th>Action</th></tr>';
        foreach ($commandes as $commande) {
            echo '<tr>';
            echo '<td>Commande n°' . $commande['ID_commande'] . '</td>';
            echo '<td>' . $commande['prix_total'] . '</td>';
            echo '<td>' . $commande['date'] . '</td>';
            echo '<td>';
            echo '<a href="detailcommande.php?id_commande='.$commande['ID_commande'].'">Voir détail</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div';
    }

    if (isset($_SESSION['user'])&&$_SESSION['user']['role'] == '1') {
        echo '<div class=paniertab>';
        echo '<table>';
        echo '<tr><th>Produit</th><th>Prix total<th>Date</th><th>Statut</th><th>Action</th></tr>';
        foreach ($commandes2 as $commande2) {
            echo '<tr>';
            echo '<td>Commande n°' . $commande2['ID_commande'] . '</td>';
            echo '<td>' . $commande2['prix_total'] . '</td>';
            echo '<td>' . $commande2['date'] . '</td>';
            if($commande2['statut_commande']==1){echo '<td>En cours</td>';}
            if($commande2['statut_commande']==2){echo '<td>Finalisée</td>';}
            if($commande2['statut_commande']==3){echo '<td>Annulée</td>';}
            echo '<td>';
            echo '<a href="editstatut.php?id_commande='.$commande2['ID_commande'].'">Modifier le statut de la commande</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div';
    }
    ?>
</body>

<?php
include "footer.php" 

?>