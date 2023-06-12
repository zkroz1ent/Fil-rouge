<?php
include "header.php";
if ($_SESSION['user']['role'] == 1) {
?>













































<?php

    include "footer.php";
} else {



?><h1>Accees non autorise</h1><?php



    include "footer.php";
}



?>