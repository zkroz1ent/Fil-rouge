<?php
session_start();
include 'sql.php';
require_once "init.php";
require_once "fpdf/fpdf.php";

setlocale(LC_TIME, 'french');
require_once 'classes/Mon_pdf.php';

$id_utilisateur = $_SESSION["user"]["id_utilisateur"];

$sql = "select * from utilisateur,adherent,commande WHERE utilisateur.id_utilisateur=adherent.id_utilisateur and utilisateur.id_utilisateur=:id_utilisateur ";
try {
    $sth = $dbh->prepare($sql);
    $sth->execute(array(
        ":id_utilisateur" => $id_utilisateur
    ));
    $utilisateur = $sth->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("<p>Erreur lors de la requête SQL 2: " . $e->getMessage() . "</p>");
}
print_r($utilisateur);
$id_commande = isset($_GET['id_commande']) ? $_GET['id_commande'] : "";
$sql = "SELECT * FROM commande WHERE id_commande=:id_commande";
try {
    $sel = $dbh->prepare($sql);
    $sel->execute(array(
        ':id_commande' => $id_commande
    ));
} catch (PDOException $ex) {
    die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
}
$commandes = $sel->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDF();
$pdf->SetTitle('PDF', true);
$pdf->SetAuthor('', true);
$pdf->SetSubject('badge', true);



$pdf->AddPage();
define('FPDF_FONTPATH', './font/');
$pdf->AddFont('Calibri', '', 'Calibri_Regular.php'); //Regular
$pdf->AddFont('Calibri', 'B', 'Calibri_bold.php'); //Bold
$pdf->Image('img/AIRNEIS.jpg', 0, 0, 210, 300);
$pdf->setY(18);
$pdf->setX(190);

$pdf->SetFont('calibri', '', 11);
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->SetFont('', 'B');
//NM ORDRE DE RECU

$pdf->SetFillColor(255, 255, 255);
$pdf->AddFont('Calibri', '', 'Calibri_Regular.php'); //Regular
$pdf->AddFont('Calibri', 'B', 'Calibri_bold.php'); //Bold


$pdf->SetFont('Calibri', '', 11);
$pdf->SetTextColor(0, 0, 0); // Noir

$pdf->setY(35.5);
$pdf->setX(28.5);
$pdf->Cell(35, 8, utf8_decode($utilisateur["ID_commande"]), 0, 0, "L", FALSE);

$pdf->setY(42);
$pdf->setX(40);
$pdf->Cell(35, 8, utf8_decode($utilisateur["date"]), 0, 0, "L", FALSE);

$pdf->setY(79.20);
$pdf->setX(153);
$pdf->SetFont('Calibri', '', 13);

$pdf->Cell(35, 8, utf8_decode("N° " . $utilisateur["id_adherent"]), 0, 0, "L", FALSE);
$pdf->setY(86);
$pdf->setX(120);
$pdf->SetFont('Calibri', '', 11);
$pdf->SetTextColor(0, 0, 0); // Noir
$pdf->Cell(35, 8, utf8_decode("NOM: " . $utilisateur["nom"]), 0, 0, "L", FALSE);
$pdf->setY(90);
$pdf->setX(120);
$pdf->Cell(35, 8, utf8_decode("PRENOM: " . $utilisateur["prenom"]), 0, 0, "L", FALSE);
$pdf->setY(94);
$pdf->setX(120);
$pdf->Cell(35, 8, utf8_decode("Num° Tel: " . $utilisateur["num_telephone"]), 0, 0, "L", FALSE);
$pdf->setY(98);
$pdf->setX(120);
$pdf->Cell(35, 8, utf8_decode("Adresse: " . $utilisateur["adresse1"]), 0, 0, "L", FALSE);
$pdf->setY(102);
$pdf->setX(120);
$pdf->Cell(35, 8, utf8_decode($utilisateur["adresse2"]), 0, 0, "L", FALSE);
$pdf->setY(106);
$pdf->setX(120);
$pdf->Cell(35, 8, utf8_decode("Code Postal: " . $utilisateur["adresse4"]), 0, 0, "L", FALSE);

$pdf->setY(110);
$pdf->setX(120);
$pdf->Cell(35, 8, utf8_decode("Pays: " . $utilisateur["Pays"]), 0, 0, "L", FALSE);
$pdf->SetFont('Calibri', 'B', 11);
$pdf->SetTextColor(0, 0, 0); // Noir



$pdf->SetFillColor(255, 255, 255);




$pdf->SetFont('calibri', '', 9);
$pdf->SetFont('', 'B');
$pdf->setY(124);
$pdf->setX(5);
$pdf->SetFillColor(177, 254, 152);
$pdf->Cell(50, 8, utf8_decode("Num° Commande"), 1, 0, "C");
$pdf->Cell(55, 8, utf8_decode("Nom Produit"), 1, 0, "C");
$pdf->Cell(20, 8, utf8_decode("prix produit"), 1, 0, "C");
$pdf->Cell(20, 8, utf8_decode("nombre"), 1, 0, "C");
$pdf->Cell(20, 8, utf8_decode("date"), 1, 0, "C");
$pdf->Cell(30, 8, utf8_decode("statut_commande"), 1, 1, "C");
$prixfinal = 0;
foreach ($commandes as $commande) {
    $sql2 = "SELECT * FROM produit WHERE id_produit=:id_produit";
    try {
        $sel = $dbh->prepare($sql2);
        $sel->execute(array(
            ':id_produit' => $commande['id_produit']
        ));
    } catch (PDOException $ex) {
        die("Erreur lors de la requête SQL INSERT ligne : " . $ex->getMessage());
    }
    $produit = $sel->fetch(PDO::FETCH_ASSOC);
    $pdf->SetFont('', '');
    $pdf->setX(5);
    $pdf->SetFillColor(177, 254, 152);
    $pdf->Cell(50, 8, utf8_decode($commande['ID_commande']), 1, 0, "C");
    $pdf->Cell(55, 8, utf8_decode($produit['lib_produit_fr']), 1, 0, "C");
    $pdf->Cell(20, 8, utf8_decode($produit['prix_produit']), 1, 0, "C");
    $pdf->Cell(20, 8, utf8_decode($commande['nombre']), 1, 0, "C");
    $pdf->Cell(20, 8, utf8_decode($commande['date']), 1, 0, "C");
    $pdf->Cell(30, 8, utf8_decode($commande['statut_commande']), 1, 1, "C");
    $prixfinal += $produit['prix_produit'] * $commande['nombre'];
}
$pdf->setY(220);
$pdf->setX(153);
$pdf->Cell(30, 8, utf8_decode("Total commande"), 1, 1, "C");
$pdf->setY(228);
$pdf->setX(153);
$pdf->Cell(30, 8, utf8_decode($prixfinal), 1, 1, "C");
$pdf->SetFillColor(133, 241, 238);



$pdf->Output('f', 'Factures/'.$_SESSION["user"]["id_utilisateur"].''.$utilisateur["ID_commande"].'.pdf');
header('Location: Factures/'.$_SESSION["user"]["id_utilisateur"].''.$utilisateur["ID_commande"].'.pdf');