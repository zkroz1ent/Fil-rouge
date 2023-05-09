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
    $sel=$dbh->prepare("SELECT * FROM produit  WHERE :id=produit.id_cat");
    $sel->execute(array(
    ':id' => $id
    ));
    $produits = $sel->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $ex){
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}
    foreach($produits AS $produit){
                    echo'<li class="incate product-item">';
                        echo'<a href="produit.php?id='.$produit['id_produit'].'" class="product-list-content" title="Chaise">';
                            echo'<div class="listimg"><img src="img\chaise'.$produit['id_produit'].'.jpg" border="0" alt="chaise" /></div>';
                            echo'<div class="list-name">'.$produit['lib_produit'].'</div>';
                            echo'<div class="prolistdesc"></div>';
                        echo'</a>';
                    echo'</li>';
    }
?>            
                </ul>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php';  ?>