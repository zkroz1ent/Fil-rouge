<?php require 'header.php';  ?>
<?php
require('function/function.php');
$id = isset($_GET['id']) ? $_GET['id'] : NULL;
$sel=$dbh->prepare("SELECT * FROM produit  WHERE :id=produit.id_cat");
$sel->execute(array(
    ':id' => $id
));
?>
<div id="index_cate" class="index_cate-section index-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
<?php
if($id==1){
    echo'<ul class="product-list">';
        echo '<li class="incate product-item">';
            echo'<a href="categorie.php?id=1" class="product-list-content" title="chaise">';
                echo'<div class="listimg"><img src="img\chaise.jpg" border="0" alt="KIOSK" /></div>';
                echo'<div class="list-name">Chaise retournée</div>';
                echo'<div class="prolistdesc"></div>';
            echo'</a>';
        echo'</li>';                          
    echo'</ul>';
}
?>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php';  ?>