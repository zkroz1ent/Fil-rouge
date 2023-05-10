<?php require 'header.php';  $i=0?>


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

<h1>Achat de produit : <?= $produit['lib_produit_fr'] ?></h1>

<div class="bois">
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<div class="carousel">
    <?php foreach ($similaires as $similaire) :$i++; ?>
        
        <div class="carousel-item">
            <a href="?id_produit=<?= $similaire['id_produit'] ?>">
                <img src="img\meuble<?= $i?>.jpg" alt="<?= $similaire['lib_produit'] ?>">
                <h3><?= $similaire['lib_produit'] ?></h3>
                <p>Prix : <?= $similaire['prix_produit'] ?> €</p>
            </a>
        </div>
    <?php endforeach; ?>
</div>


<script>
$(document).ready(function(){
    $('.carousel').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow: false,
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
        responsive: [
            {
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

   
</body>
</html>







<?php require 'footer.php';  ?>