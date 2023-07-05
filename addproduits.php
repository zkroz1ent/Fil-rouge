<?php
require('header.php');
include 'sql.php'; ?>
<?php
if ($_SESSION['user']['role'] == 1) {
?>

<body>
    
<div class="center">
    <h1>Ajout</h1>
    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="nom">Nom du produit : </label></td>
                <td><input type="text" id="nom" name="nom" value=""></td>
            </tr>
            <tr>
                <td><label for="prix">Prix : </label></td>
                <td><input type="text" id="prix" name="prix" value=""></td>
            </tr>
            <tr>
                <td><label for="stock">Stock : </label></td>
                <td><input type="text" id="stock" name="stock" value=""></td>
            </tr>
            <tr>
                <td><label for="desc">Description : </label></td>
                <td><input type="text" id="desc" name="desc" value=""></td>
            </tr>
            <tr>
                <td><label for="materiau">Matériau principal : </label></td>
                <td>
                <select name="materiau" id="materiau">
                    <option value="1">1 - Bois</option>
                    <option value="2">2 - Metal</option>
                    <option value="3">3 - Tissu</option>
                    <option value="4">4 - Cuir</option>
                    <option value="5">5 - Plastique</option>
                    <option value="6">6 - Pierre</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="categorie">Catégorie : </label></td>
                <td>
                <select name="categorie" id="categorie">
                    <option value="1">1 - Chaise</option>
                    <option value="2">2 - Canapé</option>
                    <option value="3">3 - Table</option>
                    <option value="4">4 - Lave-vaisselle</option>
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
            <td><input class="button green full" name="submit" type="submit" value="Ajouter"></td>
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
    $sql = "INSERT INTO produit (lib_produit_fr, prix_produit, stock, description_fr, id_mat_fr, id_cat, alt)
    VALUES ( :nom, :prix, :stock, :desc, :materiau, :categorie, :alt)";
        try {
            $sel = $dbh->prepare($sql);
            $sel->execute(array(
               ':nom' => $nom,
               ':prix' => $prix,
               ':stock' => $stock,
               ':desc' => $desc,
               ':materiau' => $materiau,
               ':categorie' => $categorie,
               ':alt' => $alt,
            ));

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