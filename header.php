<?php
//Création de la session
session_start();
include 'log/log.php';
include 'sql.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - santarelli group</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="img/logo.png">
</head>

<body>
    <div class="navbar">
        <ul>
            <!--Quand on arrive sur le site, seulement accueil visible-->
            <li class="ligne left"><a class="<?php if ($active == 1) {
                                                    echo "active";
                                                } ?>" href="index.php">Accueil</a></li>
            <?php

            if (isset($_SESSION['user'])) { ?>
                <li class="ligne left">
                <li class="ligne right"><a class="<?php if ($active == 4) {
                                                        echo "active";
                                                    } ?>" href="liste/deconnexion.php">Déconnexion</a></li>

                <?php
                if ($_SESSION['user']['type_util'] == 1) {
                ?>
                    <li class="ligne left"><a class=active" href="utilisateur.php">gestion badge</a></li>
                    <li class="ligne left"><a class=active" href="materiel.php">gestion materiel</a></li>
                    <li class="ligne left"><a class=active" href="imprimante.php">gestion imprimante</a></li>
                    <li class="ligne left"><a class=active" href="charger_ecran.php">charger liste ecran</a></li>
                    <li class="ligne left"><a class=active" href="charger_lap.php">charger liste pc</a></li>
                    <li class="ligne left"><a class=active" href="charger_tel.php">charger liste telephone</a></li>
                   
                <?php
                }
                if ($_SESSION['user']['type_util'] == 2) {
                ?>
                <?php }
            } else {
                ?>
                <li class="ligne right"><a class="<?php if ($active == 4) {
                                                        echo "active";
                                                    } ?>" href="connexion.php">Connexion</a></li>

            <?php }
            ?>
        </ul>
    </div>
    <div class="marge">
        <?php
        if (isset($_SESSION['messages'])) {

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