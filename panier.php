<?php require 'header.php';  ?>
<h1 style="margin-top: 60px;">Bonjour <?= $_SESSION['user']['pseudo']; ?></h1>

<?php

if (isset($_POST['add_to_panier'])) {
    $id_produit = $_POST['id_produit'];
    $product_name = $_POST['product_name'];
    $prix_produit = $_POST['prix_produit'];
    $prix_ttc = $_POST['prix_ttc'];
    $quantite = $_POST['quantite'];
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = array();
    }
    $product_found = false;
    foreach ($_SESSION['panier'] as $key => $product) {
        if ($product['id_produit'] == $id_produit) {
            $_SESSION['panier'][$key]['quantite'] += $quantite;
            $product_found = true;
            break;
        }
    }

    if (!$product_found) {
        $_SESSION['panier'][] = array(
            'id_produit' => $id_produit,
            'pseudo' => $pseudo,
            'prix_produit' => $prix_produit,
            'prix_ttc' => $prix_ttc,
            'quantite' => $quantite
        );
    }
}
if (isset($_POST['remove_from_panier'])) {
    $id_produit = $_POST['id_produit_delete'];

    foreach ($_SESSION['panier'] as $key => $product) {
        if ($product['id_produit'] == $id_produit) {
            unset($_SESSION['panier'][$key]);
            break;
        }
    }
}
echo '<div class=paniertab>';
$total_price = 0;
$total_ttc = 0;
if (isset($_SESSION['panier'])) {
    echo '<table>';
    echo '<tr><th>Produit</th><th>Prix</th><th>Prix ttc</th<th>Quantité</th><th>Action</th></tr>';
    foreach ($_SESSION['panier'] as $product) {
        echo '<tr>';
        echo '<td>' . $product['lib_produit'] . '</td>';
        echo '<td>' . $product['prix_produit'] . '€</td>';
        echo '<td>' . $product['prix_ttc'] . '€</td>';
        echo '<td>' . $product['quantite'] . '</td>';
        echo '<td>';
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="id_produit_delete" value="' . $product['id_produit'] . '">';
        echo '<input type="submit" name="remove_from_panier" value="Supprimer">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';

        $total_price += $product['prix_produit'] * $product['quantite'];
        $total_ttc += $product['prix_ttc'] * $product['quantite'];
    }
    echo '<tr><td colspan="3">Total:</td><td>' . $total_price . '€</td></tr>';
    echo '<tr><td colspan="3">Total TTC:</td><td>' . $total_ttc . '€</td></tr>';
    echo '</table>';
    echo '<div class=boutonach style="text-align: center;">';
        echo '<a href="http://localhost/fil-rouge/paiement.php" class="achat-bouton">Passer commande</a>';
    echo '</div>';
} else {
    echo '<h3>Votre panier est vide.</h3>';
}
echo '</div';
?>

<?php require 'footer.php';  ?>