<?php

require 'header.php';
$page="produit.php";
$id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : "";
$sql = "SELECT * FROM produit WHERE id_produit=:id_produit";
$i = 0;
//Lecture du produit dans la BDD 
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ':id_produit' => $id_produit
    ));
    $produit = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
$sql = "SELECT * FROM produit";
//Lecture des produits similaires dans la BDD 
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ':id_produit' => $id_produit
    ));
    $similaires = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
//Ajout du produit au panier
if (isset($_POST['id_produit'])) {
    $id_produit = $_POST['id_produit'];
    echo   $quantite = $_POST['quantite'];
    //Vérification de la quantité disponible
    if ($quantite > $produit['stock']) {
        $messageErreur = "La quantité demandée est supérieure à la quantité disponible en stock.";
    } else {
        //Vérification si le produit est déjà dans le panier
        $produitExiste = false;
   //    foreach ($_SESSION['panier'] as $key => $value) {
   //        if ($value['id_produit'] == $id_produit) {
   //            $_SESSION['panier'][$key]['quantite'] += $quantite;
   //            $produitExiste = true;
   //        }
   //    }
        //Ajout du produit au panier
        if (!$produitExiste) {
            $produitPanier = array(
                'id_produit' => $id_produit,
                'lib_produit' => $produit['lib_produit'],
                'prix_produit' => $produit['prix_produit'],
                'quantite' => $quantite
            );
            array_push($_SESSION['panier'], $produitPanier);
        }

        $messageConfirmation = "Le produit a été ajouté au panier.";
    }
}else{
}
?>
<h1>Achat de produit : <?= $produit['lib_produit_fr'] ?></h1>
<div class="produit-div">
    <div class="image-div">
        <img src="img\meuble<?= $id_produit ?>.jpg" width="300" height="400" alt="<?= $similaire['lib_produit'] ?>">
    </div>
    <div class=texte-div>
        <h2>Description</h2>
        <p><?= $produit['description_fr'] ?></p>
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
    </div>
</div>
<br><br><br>
<div class="carouselle">
    <div class="carousel">
        <?php foreach ($similaires as $similaire) : $i++; ?>
            <div class="carousel-item">
                <a href="?id_produit=<?= $similaire['id_produit'] ?>">
                    <img src="img\meuble<?= $i ?>.jpg" alt="<?= $similaire['lib_produit'] ?>">
                    <h3><?= $similaire['lib_produit'] ?></h3>
                    <p>Prix : <?= $similaire['prix_produit'] ?> €</p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.carousel').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            prevArrow: false,
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>
<?php require 'footer.php'; ?>
