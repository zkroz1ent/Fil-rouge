<?php include "header.php" ?>
<?php
$id_commande = isset($_GET['id_commande']) ? $_GET['id_commande'] : "";
$sql = "SELECT ID_commande, date, statut_commande, ROUND(SUM(prix_produit * nombre),2) AS prix_total FROM commande, produit
WHERE commande.id_produit = produit.id_produit 
AND commande.ID_commande =:id_commande GROUP BY commande.ID_commande;";
try{
    $sel = $dbh->prepare($sql);
    $sel->execute(array(
		':id_commande' => $id_commande
	));
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
        echo '<tr><th>Produit</th><th>Prix total<th>Date</th><th>Statut</th><th>Action</th></tr>';
        foreach ($commandes as $commande) {
            echo '<tr>';
            echo '<td>Commande n°' . $commande['ID_commande'] . '</td>';
            echo '<td>' . $commande['prix_total'] . '</td>';
            echo '<td>' . $commande['date'] . '</td>';?>
            <form class=form action="editstatut.php?id_commande=<?=$id_commande?>" method="post">
            <td><select name="statut" id="statut">
            <option value="1" selected ="selected">1 - En cours</option>
            <option value="2">2 - Finalisée</option>
            <option value="3">3 - Annulée</option>
            </select></td>';
            <td><input type="submit" name="submit" value="Modifier"></td>
            </form>
            </tr>
        <?php } ?>
        </table>
        </div>
<?php
$submit=isset($_POST['submit']);
$statut = isset($_POST['statut']) ? $_POST['statut'] : '';
if ($submit) {
    $sql2 = "UPDATE commande SET statut_commande=:statut WHERE id_commande=:id_commande";
    try{
        $sel = $dbh->prepare($sql2);
        $sel->execute(array(
            ':statut' => $statut,
            ':id_commande' => $id_commande
        ));
    }catch (PDOException $ex) {
        die("Erreur lors de la requête SQL SELECT ligne : " . $ex->getMessage());
    }
    echo('<script>');
    echo('window.location.href = "commandes.php";');
    echo('</script>');
}
    ?>
</body>

<?php
include "footer.php" 

?>