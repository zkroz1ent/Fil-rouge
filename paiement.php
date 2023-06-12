<?php require 'header.php';  ?>
<?php
$id_util = $_SESSION['user']['id_utilisateur'];
$sql = 'SELECT id_adherent FROM adherent WHERE id_utilisateur=:id_util';
try{
	$sel = $dbh->prepare($sql);
	$sel->execute(array(
		':id_util' => $id_util
	));
}catch (PDOException $ex) {
	die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$id_adherent = $sel->fetch(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulaire de paiement</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
			padding: 20px;
		}
		form {
			background-color: #fff;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			max-width: 500px;
			margin: 0 auto;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		label {
			display: block;
			margin-bottom: 10px;
		} 
		input[type="text"], input[type="email"], select {
			padding: 10px;
			border-radius: 4px;
			border: 1px solid #ccc;
			box-sizing: border-box;
			width: 100%;
			margin-bottom: 20px;
			font-size: 16px;
		}
	</style>

<body>
<?php
	if (isset($_SESSION['panier'])) {
		$total_price = 0;
		foreach ($_SESSION['panier'] as $product) {
			$prix_produit = $product['prix_produit'];
			$quantite = $product['quantite'];
			$total_produit = $prix_produit * $quantite;
			$total_price += $total_produit;
		}
	} else {
		echo "Votre panier est vide.";
	}
	?>
	<h2>Montant de la commande : <?=$total_price?> </h2>
<form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" placeholder="Enter your name" required>
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" placeholder="Enter your email" required>
		<label for="card">Credit Card Number:</label>
		<input type="text" id="card" name="card" placeholder="Enter your credit card number" required>
		<label for="exp">Expiration Date:</label>
		<input type="month" id="exp" name="exp" required>
		<label for="cvv">CVV:</label>
		<input type="text" id="cvv" name="cvv" placeholder="Enter your CVV" required>
		<input type="submit" id="submit" name="submit" value="Submit Payment">
	</form>
</body>
</html>
<?php 
        $submit=isset($_POST['submit']);
		$card=isset($_POST['card']) ? $_POST['card'] :  "";
		$exp=isset($_POST['exp']) ? $_POST['exp'] :  "";
		$SqlID = 'SELECT id_commande FROM commande WHERE id_commande = (SELECT MAX( id_commande )  AS idMax FROM commande)';
		try{
			$sel = $dbh->query($SqlID);
		}catch (PDOException $ex) {
			die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
		}
		$id_commande = $sel->fetch(PDO::FETCH_COLUMN);
		$id_commande = $id_commande + 1;

        if ($submit) {
			foreach ($_SESSION['panier'] as $product) {
				$id_produit = $product['id_produit'];
				$quantite = $product['quantite'];
				$sql2 = 'INSERT INTO commande(id_adherent, id_produit, nombre, date, statut_commande, ID_commande) VALUES (:id_adherent, :id_produit, :quantite, NOW(), "1", :id_commande)';
				try{
					$req = $dbh->prepare($sql2);
					$req->execute(array(
						':id_adherent' => $id_adherent,
						':id_produit' => $id_produit,
						':quantite' => $quantite,
						':id_commande' => $id_commande
					));
				}
				catch(PDOException $ex){
					die("Erreur lors de la requête SQL : " . $ex->getMessage());
				}
				$sql3 = "UPDATE produit SET stock = stock - 1 WHERE id_produit = :id_produit;";
				try{
					$req = $dbh->prepare($sql3);
					$req->execute(array(
						':id_produit' => $id_produit	
					));
				}
				catch(PDOException $ex){
					die("Erreur lors de la requête SQL : " . $ex->getMessage());
				}
			}
			$sql4 = 'INSERT INTO information_banquaire(num, date_expiration, id_adherent) VALUES (:card, :exp, :id_adherent)';
			try{
				$req = $dbh->prepare($sql4);
				$req->execute(array(
					':card' => $card,
					':exp' => $exp,
					':id_adherent' => $id_adherent
				));
			}
			catch(PDOException $ex){
				die("Erreur lors de la requête SQL : " . $ex->getMessage());
			}
			unset($_SESSION['panier']);
			$_SESSION['panier'] = array();
			echo('<script>');
  			echo('window.location.href = "paiement_validation.php";');
			echo('</script>');
		}
?>
<?php require 'footer.php';  ?>