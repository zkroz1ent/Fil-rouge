<?php
include "header.php";
if ($_SESSION['user']['role'] == 1) {
?>













































<?php

    include "footer.php";
} else {



?><h1>Accés non autorisé</h1><?php



    include "footer.php";
}



?>