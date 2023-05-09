<?php require 'header.php';  ?>


<?php
$id_produit=isset($_GET['id_produit']) ? $_GET['id_produit'] :  "";
$sql = "SELECT * FROM produit WHERE id_produit=:id_produit";
        //Lecture du pseudo dans la BDD 
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':id_produit' => $id_produit
            ));
            $produit = $sth->fetch(PDO::FETCH_ASSOC);
        } //Gestion des erreurs
        catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }


?>
<?php
$id_produit=2;
$sql = "SELECT * FROM produit";
        //Lecture du pseudo dans la BDD 
        try {
            $sth = $dbh->prepare($sql);
            $sth->execute(array(
                ':id_produit' => $id_produit
            ));
            $similaires = $sth->fetchAll(PDO::FETCH_ASSOC);
        } //Gestion des erreurs
        catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Achat de produit</title>
    <link rel="stylesheet" href="css/produit.css">

</head>
<body>
    <h1>Achat de produit : <?= $produit['lib_produit'] ?></h1>

    <p><?= $produit['description'] ?></p>

    <p>Prix : <?= $produit['prix_produit'] ?> €</p>

    <?php if (isset($messageConfirmation)) : ?>
        <p style="color: green"><?= $messageConfirmation ?></p>
    <?php endif; ?>

    <?php if (isset($messageErreur)) : ?>
        <p style="color: red"><?= $messageErreur ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>">
        <label for="quantite">Quantité :</label>
        <input type="number" name="quantite" id="quantite" min="1" max="<?= $produit['stock'] ?>" value="1">
        <button type="submit">Ajouter au panier</button>
    </form>

    <h2>Produits similaires</h2>

    <ul>
        <?php foreach ($similaires as $similaire) : ?>
            <li>
                <a href="?id_produit=<?= $similaire['id_produit'] ?>">
                    <?= $similaire['lib_produit'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

  

   
</body>
</html>







<?php require 'footer.php';  ?>