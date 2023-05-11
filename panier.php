<?php require 'header.php';  ?>


<?php

print_r($_SESSION);
// Ajouter un produit au panier
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    // Si le panier n'existe pas encore, le créer
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // Vérifier si le produit est déjà dans le panier, si oui, augmenter la quantité, sinon, l'ajouter au panier
    $product_found = false;
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $product_id) {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $product_found = true;
            break;
        }
    }
    
    if (!$product_found) {
        $_SESSION['cart'][] = array(
            'product_id' => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'quantity' => $quantity
        );
    }
}
// Supprimer un produit du panier
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $product_id) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}
// Afficher le contenu du panier
$total_price = 0;
if (isset($_SESSION['cart'])) {
    echo '<table>';
    echo '<tr><th>Produit</th><th>Prix</th><th>Quantité</th><th>Action</th></tr>';
    foreach ($_SESSION['cart'] as $product) {
        echo '<tr>';
        echo '<td>'.$product['product_name'].'</td>';
        echo '<td>'.$product['product_price'].'€</td>';
        echo '<td>'.$product['quantity'].'</td>';
        echo '<td>';
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="product_id" value="'.$product['product_id'].'">';
        echo '<input type="submit" name="remove_from_cart" value="Supprimer">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
        
        $total_price += $product['product_price'] * $product['quantity'];
    }
    echo '<tr><td colspan="3">Total:</td><td>'.$total_price.'€</td></tr>';
    echo '</table>';
} else {
    echo 'Votre panier est vide.';
}
?>
<h1>Bonjour <?= $_SESSION['user']['pseudo'] ;?></h1>
<?php require 'footer.php';  ?>