<?php
require('../Actions/payAction.php');
// Vérifie que l'étudiant est connecté
if(!isset($_SESSION['etudiant'])){
    header('Location: ../login.php');
    exit;
}

$etudiant = $_SESSION['etudiant'];
$nom = htmlspecialchars($etudiant['Nom']);
$prenom = htmlspecialchars($etudiant['Prenom']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paiement des frais</title>
</head>
<body>
    <h2>Formulaire de paiement</h2>
    <p>Étudiant : <?= $nom . " " . $prenom ?></p>

    <form action method="POST">
        <label for="montant">Montant à payer (FCFA) :</label>
        <input type="number" name="montant" id="montant" min="350000" required>
        <br><br>
        <button type="submit">Payer</button>
    </form>
</body>
</html>
