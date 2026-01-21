<?php
session_start();

// Vérifie si l'admin est connecté
if (!isset($_SESSION['admin'])) {
    header('Location: loginAdmin.php');
    exit;
}

$admin = $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f4f4;
    }

    /* Menu horizontal */
    .navbar {
        background: #2c3e50;
        padding: 15px 30px;
       
    }

    .navbar h2 {
        margin: 0;
        font-size: 30px;
        text-align: center;
        color: #fff;
    }

    .navbar a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        padding: 8px 12px;
        border-radius: 5px;
        transition: 0.2s;
    }

    .navbar a:hover {
        background: #1abc9c;
        color: #fff;
    }

    /* Contenu principal */
    .main {
        padding: 30px;
    }

    .main h1 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    .cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card {
        background: #fff;
        flex: 1 1 200px;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .card a {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 15px;
        background: #2c3e50;
        color: #fff;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }

   
</style>
</head>
<body>

<!-- Menu horizontal -->
<div class="navbar">
    <h2>Bienvenue Mr <?= htmlspecialchars($admin['nom_admin']); ?></h2>
</div>

<!-- Contenu principal -->
<div class="main">
    <h1>Tableau de bord Admin</h1>
    <div class="cards">
        <div class="card" id="gestionEtudiant">
            <h3>Gestion Étudiants</h3>
            <a href="gestion.php">Accéder</a>
        </div>
        <div class="card" id="gestionChambre">
            <h3>Gestion Chambres</h3>
            <a href="chambreA.php">Accéder</a>
        </div>
        <div class="card" id="gestionPaiements">
            <h3>Gestion Paiements</h3>
            <a href="message.php">Voir</a>
        </div>
        <div class="card" >
            <h3>Gestion Réclamations</h3>
            <a href="reclamation.php">Voir</a>
        </div>
        <div class="card" id="messages">
            <h3>Messages</h3>
            <a href="messages.php">Envoyer</a>
        </div>
    </div>
</div>

</body>
</html>
