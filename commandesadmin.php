<?php
include "header.php";
if ($_SESSION['user']['role'] == 1) {
?>

<?php
echo '<br><br>';
$id = isset($_GET['id']) ? $_GET['id'] : "";
$sql = "SELECT ID_commande, date, statut_commande, ROUND(SUM(prix_produit * nombre),2) AS prix_total FROM commande, produit
WHERE commande.id_produit = produit.id_produit 
AND commande.ID_commande = commande.ID_commande 
AND commande.id_adherent =:id GROUP BY commande.ID_commande;";
try{
    $sel = $dbh->prepare($sql);
	$sel->execute(array(
		':id' => $id
	));
}catch (PDOException $ex) {
    die("Erreur lors de la requête SQL SELECT ligne : " . $ex->getMessage());
}
$commandes = $sel->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 
    if (isset($_SESSION['user'])&&$_SESSION['user']['role'] == '1') {
        echo '<h3>Les commandes</h3>';
        echo '<div class=paniertab>';
        echo '<table>';
        echo '<tr><th>Produit</th><th>Prix total<th>Date</th><th>Statut</th><th>Action</th></tr>';
        foreach ($commandes as $commande) {
            echo '<tr>';
            echo '<td>Commande n°' . $commande['ID_commande'] . '</td>';
            echo '<td>' . $commande['prix_total'] . '</td>';
            echo '<td>' . date('d/m/Y', strtotime($commande['date'])) . '</td>';
            if($commande['statut_commande']==1){echo '<td>En cours</td>';}
            if($commande['statut_commande']==2){echo '<td>Finalisée</td>';}
            if($commande['statut_commande']==3){echo '<td>Annulée</td>';}
            echo '<td>';
            echo '<a href="editstatut.php?id_commande='.$commande['ID_commande'].'">Modifier le statut de la commande</a>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        echo '</div';
    }
?>

<?php

    include "footer.php";
} else {



?><h1>Accés non autorisé</h1><?php



    include "footer.php";
}



?>