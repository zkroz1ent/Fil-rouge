<?php require 'header.php';  ?>
<?php
require('function/function.php');
$id = isset($_GET['id']) ? $_GET['id'] : NULL;
?>
<div id="index_cate" class="index_cate-section index-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="product-list">
<?php
try{
    $sel=$dbh->prepare("SELECT * FROM produit WHERE :id=produit.id_cat");
    $sel->execute(array(
    ':id' => $id
    ));
    $produits = $sel->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $ex){
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
    foreach($produits AS $produit){?>
                    <li class="incate product-item">
                        <a href="produit.php?id_produit=<?=$produit["id_produit"]?>" class="product-list-content" title="Chaise">
                            <div class="listimg"><img src="img/<?=$produit['alt']?>" border="0" alt="<?=$produit['alt']?>"/></div>
                            <div class="list-name"><?=$produit['lib_produit_fr']?></div>
                            <div class="prolistdesc"></div>
                        </a>
                    </li>
<?php   }
?>            
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php';  ?>