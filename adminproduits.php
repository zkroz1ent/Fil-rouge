<?php
include "header.php";
if ($_SESSION['user']['role'] == 1) {
?>
<body>
    <br>
    <br>
    <h3>Bonjour <?= $_SESSION['user']['pseudo']; ?></h3>
    <br>
    <h4><a href="addproduits.php">Ajouter un produit</a></h4>
    <?php
    try{
        $sel=$dbh->query("SELECT * FROM produit");
        $produits = $sel->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $ex){
        die("Erreur lors de la requête SQL : " . $ex->getMessage());
    }
echo '<div class=paniertab>';
    echo '<table>';
        echo '<tr><th>ID</th><th>Nom<th>Prix</th><th>Stock</th><th>Description</th><th>Matériau principal</th><th>Image</th><th>Catégorie</th><th>Actions</th></tr>';
            foreach($produits AS $produit){?>
                <tr><td><?=$produit['id_produit']?></td>
                <td><?=$produit['lib_produit_fr']?></td>
                <td><?=$produit['prix_produit']?></td>
                <td><?=$produit['stock']?></td>
                <td><?=$produit['description_fr']?></td>
                <?php 
                if($produit['id_mat_fr']==1){
                echo '<td>Bois</td>';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==2){
                echo '<td>Metal</td>';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==3){
                echo '<td>Tissu</td>';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==4){
                echo '<td>Cuir</td>';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==5){
                echo '<td>Plastique</td>';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==6){
                echo '<td>Pierre</td>';                }
                ?>
                <td><img src="img/<?=$produit['alt']?>" alt="<?=$produit['alt']?> " width="100" height="100"></td>
                <?php 
                if($produit['id_cat']==1){
                echo '<td>Chaise</td>';                }
                ?>
                <?php 
                if($produit['id_cat']==2){
                echo '<td>Canapé</td>';                }
                ?>
                <?php 
                if($produit['id_cat']==3){
                echo '<td>Table</td>';                }
                ?>
                <?php 
                if($produit['id_cat']==4){
                echo '<td>Lave-vaisselle</td>';                }
                ?>
                <td><a href="editproduits.php?id=<?=$produit['id_produit']?>">Modifier</a> <a href="deleteproduits.php?id=<?=$produit['id_produit']?>">Supprimer</a></td></tr>        
            <?php
            }
    
            ?>
    </table>
</div>
</body>






































<?php

    include "footer.php";
} else {



?><h1>Accés non autorisé</h1><?php



    include "footer.php";
}



?>