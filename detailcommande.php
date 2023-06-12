<?php include "header.php" ?>
<?php 
$id_commande = isset($_GET['id_commande']) ? $_GET['id_commande'] : "";
$sql = "SELECT * FROM commande WHERE id_commande=:id_commande";
try{
	$sel = $dbh->prepare($sql);
	$sel->execute(array(
		':id_commande' => $id_commande
	));
}catch (PDOException $ex) {
	die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$commandes = $sel->fetchAll(PDO::FETCH_ASSOC);

echo '<div class=paniertab>';
echo '<table>';
echo '<tr><th>ID_Commande</th><th>Nom produit<th>Nombre</th><th>Prix unité</th><th>Prix total</th><th>Date</th><th>Statut</th><th>Impression</th></tr>';
foreach ($commandes as $commande) {
    $sql2 = "SELECT * FROM produit WHERE id_produit=:id_produit";
    try{
        $sel = $dbh->prepare($sql2);
        $sel->execute(array(
            ':id_produit' => $commande['id_produit']
        ));
    }catch (PDOException $ex) {
        die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
    }
    $produit = $sel->fetch(PDO::FETCH_ASSOC);
    echo '<tr>';
    echo '<td>Commande n°' . $commande['ID_commande'] . '</td>';
    echo '<td>' . $produit['lib_produit_fr'] . '</td>';
    echo '<td>' . $commande['nombre'] . '</td>';
    echo '<td>' . $produit['prix_produit'] . '</td>';
    echo '<td>' . $commande['nombre']*$produit['prix_produit'] . '</td>';
    echo '<td>' . $commande['date'] . '</td>';
    
    echo '<td> En cours</td>';
    echo '<td><a href="facture_pdf.php?id_commande='.$commande['ID_commande'].'">Imprimer</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div';
?>



<?php
include "footer.php" 
?>