<?php
include "header.php";
if ($_SESSION['user']['role'] == 1) {
?>
<body>
    <h3>Bonjour <?= $_SESSION['user']['pseudo']; ?></h3>
    <div style="text-align: center;"><a href="settings.php"><img src="img\settings.jpg" alt="settings"></a>
    <a href="commandes.php"><img src="img\commande.png" alt="commandes"></a>
    </div>
</body>






































<?php

    include "footer.php";
} else {



?><h1>Accés non autorisé</h1><?php



    include "footer.php";
}



?>