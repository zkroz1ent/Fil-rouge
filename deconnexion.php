<?php require 'header.php';
unset($_SESSION['user']);
$_SESSION['messages'] = array(
    "deconnexion" => ["blue", "Vous vous êtes bien déconnecté"]
);
echo('<script>');
echo('window.location.href = "index.php";');
echo('</script>');
require 'footer.php';  ?>