<?php
require 'header.php';
$page = "produit.php";
$id_produit = isset($_GET['id_produit']) ? $_GET['id_produit'] : "";
$sql = "SELECT * FROM produit WHERE id_produit=:id_produit";
$i = 0;

try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ':id_produit' => $id_produit
    ));
    $produit = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

$sql_similaires = "SELECT * FROM produit WHERE id_produit != :id_produit";
try {
    $sth_similaires = $dbh->prepare($sql_similaires);
    $sth_similaires->execute(array(
        ':id_produit' => $id_produit
    ));
    $similaires = $sth_similaires->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

if (isset($_POST['id_produit'])) {
    $id_produit = $_POST['id_produit'];
    $quantite = $_POST['quantite'];

    if ($quantite > $produit['stock']) {
        $messageErreur = "La quantité demandée est supérieure à la quantité disponible en stock.";
    } else {
        $produitExiste = false;
        foreach ($_SESSION['panier'] as $key => $value) {
            if ($value['id_produit'] == $id_produit) {
                $_SESSION['panier'][$key]['quantite'] += $quantite;
                $produitExiste = true;
            }
        }
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
}
?>

<h1>Achat de produit : <?= $produit['lib_produit_fr'] ?></h1>
<?php 
if($produit['id_mat_fr']==1){

echo'<div class="produit-bois">';

}
?>
<?php 
if($produit['id_mat_fr']==2){

echo '<div class="produit-metal">';

}
?>

<?php 
if($produit['id_mat_fr']==3){

echo '<div class="produit-tissu">';

}
?>

<?php 
if($produit['id_mat_fr']==4){

echo '<div class="produit-cuir">';

}
?>

<?php 
if($produit['id_mat_fr']==5){

echo '<div class="produit-plastique">';

}
?>

<?php 
if($produit['id_mat_fr']==6){

echo '<div class="produit-pierre">';

}
?>

    <div class="image-div">
        <img src="img/<?=$produit['alt']?>.jpg" width="300" height="400" alt="<?= $produit['lib_produit'] ?>">
    </div>
    <div class="texte-div">
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

<div class="carousel">
    <?php foreach ($similaires as $similaire) : $i++; ?>
        <div class="carousel-item">
            <a href="?id_produit=<?= $similaire['id_produit'] ?>">
                <img src="img/meuble<?= $i ?>.jpg" alt="<?= $similaire['lib_produit_fr'] ?>">
                <h3><?= $similaire['lib_produit_fr'] ?></h3>
                <p>Prix : <?= $similaire['prix_produit'] ?> €</p>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

<script>
    $(document).ready(function() {
        $('.carousel').slick({
            slidesToShow: 5,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 3000,
            prevArrow: false,
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
    });
</script>

<?php require 'footer.php'; ?>
