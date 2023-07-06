<?php
include "header.php" 

?>

<body>
    <h3 style="
    margin-left: 1008px;
    margin-top: 70px;">Bonjour <?= $_SESSION['user']['pseudo']; ?></h3>
    <div style="text-align: center;"><a href="settings.php"><img src="img\settings.jpg" alt="settings"></a>
    <a href="commandes.php"><img src="img\commande.png" alt="commandes"></a>
    </div>
</body>

<?php
include "footer.php" 

?>