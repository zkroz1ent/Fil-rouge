<?php
require('header.php');
include 'sql.php'; ?>

<?php
if ($_SESSION['user']['role'] == 1) {
?>

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
<body>
    
<div class="center">
    <h1>Modification</h1>
    <form class="form" action="editproduits.php?id=<?=$id?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="ID">ID du produit : </label></td>
                <td><input type="text" id="ID" name="ID" value="<?=$id?>" disabled></td>
            </tr>
            <tr>
                <td><label for="nom">Nom du produit : </label></td>
                <td><input type="text" id="nom" name="nom" value="<?=$produit['lib_produit_fr']?>"></td>
            </tr>
            <tr>
                <td><label for="prix">Prix : </label></td>
                <td><input type="text" id="prix" name="prix" value="<?=$produit['prix_produit']?>"></td>
            </tr>
            <tr>
                <td><label for="stock">Stock : </label></td>
                <td><input type="text" id="stock" name="stock" value="<?=$produit['stock']?>"></td>
            </tr>
            <tr>
                <td><label for="desc">Description : </label></td>
                <td><input type="text" id="desc" name="desc" value="<?=$produit['description_fr']?>"></td>
            </tr>
            <tr>
                <td><label for="materiau">Matériau principal : </label></td>
                <td>
                <select name="materiau" id="materiau">
                    <option value="1" <?php if ($produit['id_mat_fr'] == 1) echo 'selected'; ?>>1 - Bois</option>
                    <option value="2" <?php if ($produit['id_mat_fr'] == 2) echo 'selected'; ?>>2 - Metal</option>
                    <option value="3" <?php if ($produit['id_mat_fr'] == 3) echo 'selected'; ?>>3 - Tissu</option>
                    <option value="4" <?php if ($produit['id_mat_fr'] == 4) echo 'selected'; ?>>4 - Cuir</option>
                    <option value="5" <?php if ($produit['id_mat_fr'] == 5) echo 'selected'; ?>>5 - Plastique</option>
                    <option value="6" <?php if ($produit['id_mat_fr'] == 6) echo 'selected'; ?>>6 - Pierre</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="categorie">Catégorie : </label></td>
                <td>
                <select name="categorie" id="categorie">
                    <option value="1" <?php if ($produit['id_cat'] == 1) echo 'selected'; ?>>1 - Chaise</option>
                    <option value="2" <?php if ($produit['id_cat'] == 2) echo 'selected'; ?>>2 - Canapé</option>
                    <option value="3" <?php if ($produit['id_cat'] == 3) echo 'selected'; ?>>3 - Table</option>
                    <option value="4" <?php if ($produit['id_cat'] == 4) echo 'selected'; ?>>4 - Cuir</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="image">Image :</label></td>
                <td>
                <input type="file" name="alt" id="alt" accept="image/jpeg, image/png">
                </td>
            </tr>
            <tr>
            <td><input class="button green full" name="submit" type="submit" value="Modifier"></td>
            </tr>
        </table>
    </form>
</div>

</body>

<?php

$submit=isset($_POST['submit']);
if ($submit) {
    $nom=isset($_POST['nom']) ? $_POST['nom'] :  "";
    $prix=isset($_POST['prix']) ? $_POST['prix'] :  "";
    $stock=isset($_POST['stock']) ? $_POST['stock'] :  "";
    $desc=isset($_POST['desc']) ? $_POST['desc'] :  "";
    $materiau=isset($_POST['materiau']) ? $_POST['materiau'] :  "";
    $categorie=isset($_POST['categorie']) ? $_POST['categorie'] :  "";
    $alt = isset($_FILES['alt']['name']) ? $_FILES['alt']['name'] : "";
    if (isset($_FILES['alt']) && $_FILES['alt']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['alt'];
        $filename = $file['name'];
        $tempFilePath = $file['tmp_name'];
        
        // Déplacer le fichier téléchargé vers le dossier /img avec un nom unique
        $targetDir = 'img/';
        $alt = $filename;
        $targetFilePath = $targetDir . $alt;
        move_uploaded_file($tempFilePath, $targetFilePath);
    }
    $sql2 = "UPDATE produit SET lib_produit_fr=:nom, prix_produit=:prix, stock=:stock, description_fr=:desc, id_mat_fr=:materiau, id_cat=:categorie, alt=:alt 
    WHERE id_produit=:id";
        try {
            $sel = $dbh->prepare($sql2);
            $sel->execute(array(
               ':nom' => $nom,
               ':prix' => $prix,
               ':stock' => $stock,
               ':desc' => $desc,
               ':materiau' => $materiau,
               ':categorie' => $categorie,
               'alt' => $alt,
               ':id' => $id
            ));
            echo('<script>');
            echo('window.location.href = "adminproduits.php";');
            echo('</script>');
          }catch (PDOException $ex) {
              die("Erreur lors de la requête SQL UPDATE ligne : " . $ex->getMessage());
          }
            $rows = $sel->fetchAll(PDO::FETCH_ASSOC);

}

?>

<?php

    include "footer.php";
} else {



?><h1>Accés non autorisé</h1><?php



    include "footer.php";
}



?>