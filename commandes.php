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
AND commande.ID_commande = commande.ID_commande GROUP BY commande.ID_commande;";
try{
    $sel = $dbh->query($sql2);
}catch (PDOException $ex) {
    die("Erreur lors de la requête SQL SELECT ligne : " . $ex->getMessage());
}
$commandes = $sel->fetchAll(PDO::FETCH_ASSOC); 
?>

<body>
    <h1>Bonjour <?= $_SESSION['user']['pseudo']; ?></h1>
    <h3>Mes commandes</h3>
    <?php
        echo '<div class=paniertab>';
        echo '<table>';
        echo '<tr><th>Produit</th><th>Prix total<th>Date</th><th>Action</th></tr>';
        foreach ($commandes as $commande) {
            echo '<tr>';
            echo '<td>Commande n°' . $commande['ID_commande'] . '</td>';
            echo '<td>' . $commande['prix_total'] . '</td>';
            echo '<td>' . $commande['date'] . '</td>';
            echo '<td>';
            echo '<form method="post" action="">';
            echo '<input type="submit" name="print" value="imprimer">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    echo '</div';
    ?>
</body>

<?php
include "footer.php" 

?>