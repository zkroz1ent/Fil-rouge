<?php
require('header.php');
include 'sql.php'; ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : "";
$sql = "SELECT * FROM produit WHERE id_produit=:id";
$i = 0;

try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ':id' => $id
    ));
    $produit = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL : " . $ex->getMessage());
}

?>
<?php 
                if($produit['id_mat_fr']==1){
                    $materiau = 'Bois';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==2){
                    $materiau = 'Metal';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==3){
                    $materiau = 'Tissu';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==4){
                    $materiau = 'Cuir';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==5){
                    $materiau = 'Plastique';                }
                ?>
                <?php 
                if($produit['id_mat_fr']==6){
                    $materiau = 'Pierre';                }
?>

<?php 
                if($produit['id_cat']==1){
                    $categorie = 'Chaise';                }
                ?>
                <?php 
                if($produit['id_cat']==2){
                    $categorie = 'Canape';                }
                ?>
                <?php 
                if($produit['id_cat']==3){
                    $categorie = 'Table';                }
                ?>
                <?php 
                if($produit['id_cat']==4){
                    $categorie = 'Lave-vaisselle';                }
                ?>
<body>
    
<div class="center">
    <h1>Suppression</h1>
    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table>
            <tr>
                <td><label for="ID">ID du produit : </label></td>
                <td><input type="text" id="ID" name="ID" value="<?=$id?>" disabled></td>
            </tr>
            <tr>
                <td><label for="nom">Nom du produit : </label></td>
                <td><input type="text" id="nom" name="nom" value="<?=$produit['lib_produit_fr']?>" disabled></td>
            </tr>
            <tr>
                <td><label for="prix">Prix : </label></td>
                <td><input type="text" id="prix" name="prix" value="<?=$produit['prix_produit']?>" disabled></td>
            </tr>
            <tr>
                <td><label for="stock">Stock : </label></td>
                <td><input type="text" id="stock" name="stock" value="<?=$produit['stock']?>" disabled></td>
            </tr>
            <tr>
                <td><label for="desc">Description : </label></td>
                <td><input type="text" id="desc" name="desc" value="<?=$produit['description_fr']?>" disabled></td>
            </tr>
            <tr>
                <td><label for="materiau">Matériau principal : </label></td>
                <td><input type="text" id="materiau" name="materiau" value="<?=$materiau?>" disabled></td>
            </tr>
            <tr>
                <td><label for="categorie">Catégorie : </label></td>
                <td><input type="text" id="categorie" name="categorie" value="<?=$categorie?>" disabled></td>
            </tr>
            <td><input class="button green full" name="submit" type="submit" value="Supprimer"></td>
            </tr>
        </table>
    </form>
</div>

</body>