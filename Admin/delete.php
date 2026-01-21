<?php
require('../Actions/database.php');

// Vérifie si l'ID est passé
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: gestion.php");
    exit;
}

$id = $_GET['id'];

// Supprime l'étudiant
$sql = "DELETE FROM etudiant WHERE Id_Etudiant = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id]);

// Redirige vers la page de gestion
header("Location: gestion.php");
exit;
?>
