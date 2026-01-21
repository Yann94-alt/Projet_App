<?php
session_start();
require('../Actions/database.php');

if (!isset($_SESSION['etudiant'])) {
    header('Location: ../login.php');
    exit;
}

$etudiant = $_SESSION['etudiant'];

// Infos de l'étudiant
$nom       = htmlspecialchars($etudiant['Nom']);
$prenom    = htmlspecialchars($etudiant['Prenom']);
$idEtudiant = htmlspecialchars($etudiant['Id_Etudiant']);
$niveau    = htmlspecialchars($etudiant['Niveau']);
$filiere   = htmlspecialchars($etudiant['Filiere']);
$sexe      = htmlspecialchars($etudiant['Sexe']);
$telephone = htmlspecialchars($etudiant['Telephone']);

// Récupérer le numéro de chambre et de logement
$stmt = $bdd->prepare("
    SELECT e.numero_logement, c.numero_chambre 
    FROM etudiant e
    LEFT JOIN chambre c ON e.id_chambre = c.id_chambre
    WHERE e.Id_Etudiant = ?
");
$stmt->execute([$idEtudiant]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

$numeroChambre  = !empty($res['numero_chambre']) ? htmlspecialchars($res['numero_chambre']) : 'Non attribué';
$numeroLogement = !empty($res['numero_logement']) ? htmlspecialchars($res['numero_logement']) : 'Non attribué';

// Année académique
$anneeAcademique = "2025-2026";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Profil Étudiant</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    margin: 0;
    padding: 20px;
}

.profile-card {
    max-width: 800px;
    margin: 50px auto;
    display: flex;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    overflow: hidden;
}

/* Partie gauche (icône + ID) */
.profile-left {
    width: 35%;
    background: #e9ecef;
    text-align: center;
    padding: 30px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.profile-left .icon {
    font-size: 100px;
    margin-bottom: 15px;
}

.profile-left .id {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 15px;
}

/* Partie droite (infos) */
.profile-right {
    width: 65%;
    padding: 30px;
}

.profile-right h2 {
    margin-top: 0;
    margin-bottom: 10px;
    font-size: 28px;
}

.profile-right p {
    margin: 8px 0;
    font-size: 16px;
}

.buttons {
    margin-top: 25px;
}

.buttons button {
    padding: 10px 18px;
    margin-right: 10px;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.buttons .edit {
    background-color: #3498db;
    color: white;
}

.buttons .delete {
    background-color: #e74c3c;
    color: white;
}
</style>
<!-- Utilisation d'icône simple -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<div class="profile-card">
    <!-- Partie gauche -->
    <div class="profile-left">
        <i class="fas fa-user-circle icon"></i>
        <div class="id">ID: <?= $idEtudiant ?></div>
        <div class="annee"><strong>Année académique :</strong> <?= $anneeAcademique ?></div>
    </div>

    <!-- Partie droite -->
    <div class="profile-right">
        <h2><?= $nom . ' ' . $prenom ?></h2>
        <p><strong>Sexe :</strong> <?= $sexe ?></p>
        <p><strong>Niveau :</strong> <?= $niveau ?></p>
        <p><strong>Filière :</strong> <?= $filiere ?></p>
        <p><strong>Téléphone :</strong> <?= $telephone ?></p>
        <p><strong>Numéro chambre :</strong> <?= $numeroChambre ?></p>
        <p><strong>Numéro logement :</strong> <?= $numeroLogement ?></p>

        <div class="buttons">
            <button class="edit">Modifier</button>
            <button class="delete">Supprimer</button>
        </div>
    </div>
</div>

</body>
</html>
