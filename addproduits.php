<?php
require('header.php');
include 'sql.php'; ?>

<body>
    
<div class="center">
    <h1>Ajout</h1>
    <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
                    <option value="4">4 - Cuir</option>
                </select>
                </td>
            </tr>
            <td><input class="button green full" name="submit" type="submit" value="Ajouter"></td>
            </tr>
        </table>
    </form>
</div>

</body>