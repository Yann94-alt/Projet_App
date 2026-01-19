<?php
session_start();
require('../Actions/database.php');

// Vérifie si l'étudiant est connecté
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
<title>Dashboard Étudiant</title>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    margin:0;
    font-family: Arial, sans-serif;
    display:flex;
    min-height:100vh;
    background:#f4f6f9;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    background: #1e3a8a;
    color: #fff;
    display: flex;
    flex-direction: column;
    padding-top: 20px;
}

.sidebar .profile {
    display:flex;
    flex-direction: column;
    align-items: center;
    gap:10px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}

.sidebar .profile ion-icon {
    font-size:3rem;
}

.sidebar nav {
    flex:1;
    padding-top:20px;
}

.sidebar nav ul {
    list-style:none;
    padding:0;
    margin:0;
}

.sidebar nav ul li {
    margin-bottom:10px;
}

.sidebar nav ul li a {
    color:#fff;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:10px;
    padding:10px 20px;
    border-radius:5px;
}

.sidebar nav ul li a:hover {
    background: rgba(255,255,255,0.1);
}

/* MAIN */
.main {
    flex:1;
    padding:20px;
}

/* TOP BAR */
.top-bar {
    display:flex;
    justify-content: space-between;
    align-items: center;
    background: #2563eb;
    color: #fff;
    padding: 40px 25px;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

.top-bar h1 {
    margin:0;
    font-size:2.4rem;
    display:flex;
    align-items:center;
    gap:10px;
}

.top-bar a.logout {
    text-decoration:none;
    color:#fff;
    background:#dc2626;
    padding:10px 20px;
    border-radius:8px;
    font-weight:bold;
    transition:0.3s;
}

.top-bar a.logout:hover {
    background:#b91c1c;
}

/* CARDS */
.cardBox {
    display:flex;
    justify-content: space-between;
    gap:20px;
    margin-bottom:20px;
    flex-wrap: nowrap;
    overflow-x:auto;
}

.card {
    flex: 0 0 22%;
    min-width: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
    text-align:center;
}

.card ion-icon {
    font-size:2rem;
    margin-bottom:10px;
    color:#1e3a8a;
}

/* CARROUSEL */
.carousel-item img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.15);
    margin-bottom:20px;
}

/* REGLES DE CITE */
.rules-box {
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
    margin-top:20px;
}

.rules-box h2 {
    margin-bottom:15px;
}

.rules-box ul {
    padding-left:20px;
}

.rules-box ul li {
    margin-bottom:10px;
}

/* RESPONSIVE */
@media(max-width: 992px){
    body {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        flex-direction: row;
        overflow-x: auto;
    }

    .sidebar nav ul {
        display:flex;
        flex-direction: row;
        gap:10px;
    }

    .sidebar nav ul li {
        margin-bottom:0;
    }

    .main {
        padding:15px;
    }

    .top-bar {
        flex-direction: column;
        align-items:flex-start;
        gap:10px;
    }

    .top-bar h1 {
        font-size:2rem;
    }

    .cardBox {
        flex-wrap: nowrap;
        overflow-x: auto;
    }

    .card {
        flex: 0 0 auto;
    }
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="profile">
        <ion-icon name="person-circle-outline"></ion-icon>
        <p><?= $prenom ?> <?= $nom ?></p>
    </div>
    <nav>
        <ul>
            <li><a href="#"><ion-icon name="bed-outline"></ion-icon> Ma chambre</a></li>
            <li><a href="../Etudiant/pay.php"><ion-icon name="card-outline"></ion-icon> Paiements</a></li>
            <li><a href="#"><ion-icon name="mail-outline"></ion-icon> Messages</a></li>
            <li><a href="#"><ion-icon name="document-text-outline"></ion-icon> Documents</a></li>
            <li><a href="#"><ion-icon name="trash-outline"></ion-icon> Supprimer Compte</a></li>
        </ul>
    </nav>
</div>

<!-- CONTENU PRINCIPAL -->
<div class="main">
    <div class="top-bar">
        <h1>Espace Étudiant</h1>
        <a href="logout.php" class="logout"><ion-icon name="log-out-outline"></ion-icon> Déconnexion</a>
    </div>

    <!-- CARTES -->
    <div class="cardBox">
        <div class="card">
            <ion-icon name="restaurant-outline"></ion-icon>
            <p>Menu Restaurant</p>
        </div>
        <div class="card">
            <ion-icon name="book-outline"></ion-icon>
            <p>Programme des Cours</p>
        </div>
        <div class="card">
            <ion-icon name="medkit-outline"></ion-icon>
            <p>Infirmerie</p>
        </div>
        <div class="card">
            <ion-icon name="football-outline"></ion-icon>
            <p>Activités Sportives</p>
        </div>
    </div>

    <!-- CARROUSEL -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../Etudiant/images/image1.png.jpg" class="d-block w-100" >
        </div>
        <div class="carousel-item">
          <img src="../Etudiant/images/image2.jpg" class="d-block w-100" alt="Cité 2">
        </div>
        <div class="carousel-item">
          <img src="../Etudiant/images/image3.jpg" class="d-block w-100" alt="Cité 3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    <!-- REGLES DE LA CITE -->
    <div class="rules-box">
        <h2>Règles d'entrée en cité</h2>
        
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
