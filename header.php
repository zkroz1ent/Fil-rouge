<?php
//Création de la session
session_start();
include 'log/log.php';
include 'sql.php';
//error_reporting(E_ERROR | E_PARSE);
?>
<!-- Bouton pour ouvrir la modale -->


<!-- Modale -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Résultats de la recherche</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Contenu de la modale -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function search() {
        // Récupérer la valeur de la recherche
        var query = document.getElementById("search-input").value;

        // Envoyer une requête AJAX pour récupérer les résultats
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "recherche-produits.php?search=" + query, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Récupérer les résultats de la recherche
                var products = JSON.parse(xhr.responseText);

                // Créer une variable pour stocker le code HTML des produits
                var productsHtml = '';

                // Parcourir la liste des produits et construire le HTML correspondant
                for (var i = 0; i < products.length; i++) {
                    var product = products[i];
                    var imageSrc = 'chemin/vers/image/' + product.id_produit + '.jpg';

                    // Si c'est le premier produit de la ligne, ouvrir une nouvelle ligne
                    if (i % 5 == 0) {
                        productsHtml += '<div class="row">';
                    }

                    // Ajouter le code HTML du produit
                    productsHtml += '<div class="col-md-2">';
                    productsHtml += '<a href="produit.php?id_produit=' + product.id_produit + '">';
                    productsHtml += '<img src="img/meuble' + product.id_produit + '.jpg" alt="' + product.id_produit + '">';
                    productsHtml += '<h5>' + product.lib_produit_fr + '</h5>';
                    productsHtml += '<p>' + product.prix_produit + '€</p>';
                    productsHtml += '</a>';
                    productsHtml += '</div>';

                    // Si c'est le dernier produit de la ligne, fermer la ligne
                    if (i % 5 == 4 || i == products.length - 1) {
                        productsHtml += '</div>';
                    }
                }

                // Afficher les résultats dans la modale
                var modalBody = document.querySelector(".modal-body");
                modalBody.innerHTML = productsHtml;

                // Ouvrir la modale
                $('#myModal').modal('show');
            }
        };

        xhr.send();
    }
</script>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/indexcss.css">
    <link rel="stylesheet" href="css/index1.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnresource.gtmc.app/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnresource.gtmc.app/magnific-popup/0.9.9/magnific-popup.min.css">
    <link rel="stylesheet" href="https://cdnresource.gtmc.app/swiper/4.5.1/css/swiper.min.css">
    <link rel="stylesheet" href="https://cdnresource.gtmc.app/iconfonts/fontawesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/glide.min.js"></script>
    <div id="index_header" class="sb-site sider-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="company_logo">
                        <a href="http://localhost/fil-rouge/index.php"><img width="50" height="50" src="http://localhost/fil-rouge/img/meuble.png"></a>
                    </div>
                    <div id="hello_member">
                        <ul class="nav nav-pills">
                            <?php if (isset($_SESSION['user'])) { ?>
                                <li id="m7" t><a href="deconnexion.php">Se deconnecter</a>
                                </li>
                            <?php } else { ?>
                                <li id="m7" t><a href="inscription.php">Inscription</a>
                                </li>
                                <li id="m7"><a href="connexion.php">Connexion</a>
                                </li>
                            <?php } ?>
                            <div id="company_logo">
                                <a href="http://localhost/fil-rouge/panier.php"><img width="50" height="50" src="http://localhost/fil-rouge/img/oip.png"></a>
                            </div>
                        </ul>
                    </div>
                    <div class="search-container">
                        <form onsubmit="search(); return false;">
                            <input type="text" id="search-input">
                            <button type="submit">Rechercher</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="marge">
        <?php
        if (isset($_SESSION['messages'])) {
            // Permet d'afficher les messages sur toutes les autres pages
            foreach ($_SESSION['messages'] as $key => $value) {
                echo '<div class="popup ' . $value[0] . '">';
                echo "<p><strong>" . $key . "</strong> : " . $value[1] . "</p>";
            }
            //Détruit la variable message
            unset($_SESSION['messages']);
            echo "</div>";
        }
        echo '<br>';
        ?>
    </div>
</head>