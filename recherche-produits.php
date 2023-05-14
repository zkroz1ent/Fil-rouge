<?php
header('Content-Type: application/json');

include 'sql.php';

$query = $_GET['search'];

$stmt = $dbh->prepare("SELECT * FROM produit WHERE lib_produit_fr LIKE :query");
$stmt->bindValue(':query', '%'.$query.'%', PDO::PARAM_STR);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
  echo json_encode($results);
} else {
  echo json_encode(array('message' => 'Aucun résultat trouvé'));
}
?>
