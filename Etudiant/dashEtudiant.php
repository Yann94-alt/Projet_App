<?php
session_start();
require('../Actions/database.php');

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

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<style>
:root{
    --primary:#1e40af;
    --secondary:#2563eb;
    --accent:#38bdf8;
    --danger:#dc2626;
    --bg:#f1f5f9;
}

body{
    margin:0;
    display:flex;
    min-height:100vh;
    background:var(--bg);
    font-family: 'Segoe UI', sans-serif;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    background:linear-gradient(180deg,#1e3a8a,#1e40af);
    color:#fff;
    padding:20px 0;
}

.profile{
    text-align:center;
    padding-bottom:20px;
    border-bottom:1px solid rgba(255,255,255,0.2);
}

.profile ion-icon{
    font-size:3.5rem;
    color:var(--accent);
}

.sidebar ul{
    list-style:none;
    padding:0;
    margin-top:20px;
}

.sidebar ul li a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 25px;
    color:#fff;
    text-decoration:none;
    transition:0.3s;
}

.sidebar ul li a:hover{
    background:rgba(255,255,255,0.15);
    transform:translateX(5px);
}

/* MAIN */
.main{
    flex:1;
    padding:25px;
}

/* TOP BAR */
.top-bar{
    background:linear-gradient(135deg,#2563eb,#1e40af);
    color:#fff;
    padding:30px;
    border-radius:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.logout{
    background:var(--danger);
    color:#fff;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
}

/* CARDS */
.cardBox{
    display:flex;
    gap:20px;
    margin-bottom:30px;
    overflow-x:auto;
}

.card{
    min-width:200px;
    background:#fff;
    padding:25px;
    border-radius:15px;
    text-align:center;
    text-decoration:none;
    color:#000;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    transition:0.3s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.card ion-icon{
    font-size:3rem;
    color:var(--secondary);
    margin-bottom:10px;
}

.card p{
    font-weight:600;
}

/* CAROUSEL */
.carousel-item img{
    height:300px;
    object-fit:cover;
    border-radius:15px;
}

/* RULES */
.rules-box{
    background:#fff;
    padding:25px;
    border-radius:15px;
    margin-top:30px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    border-left:6px solid var(--secondary);
}

.rules-box h2{
    color:var(--primary);
}

/* RESPONSIVE */
@media(max-width:768px){
    body{flex-direction:column;}
    .sidebar{width:100%;}
    .cardBox{flex-wrap:nowrap;}
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

    <ul>
        <li><a href="#"><ion-icon name="bed-outline"></ion-icon> Ma chambre</a></li>
        <li><a href="../Etudiant/pay.php"><ion-icon name="card-outline"></ion-icon> Paiements</a></li>
        <li><a href="#"><ion-icon name="mail-outline"></ion-icon> Messages</a></li>
        <li><a href="#"><ion-icon name="document-text-outline"></ion-icon> Documents</a></li>
        <li><a href="#"><ion-icon name="trash-outline"></ion-icon> Supprimer Compte</a></li>
    </ul>
</div>

<!-- MAIN -->
<div class="main">

    <div class="top-bar">
        <h1>Espace Étudiant</h1>
        <a href="logout.php" class="logout">
            <ion-icon name="log-out-outline"></ion-icon> Déconnexion
        </a>
    </div>

    <!-- CARDS -->
    <div class="cardBox">
        <a href="lien/restaurant.php" class="card">
            <ion-icon name="restaurant-outline"></ion-icon>
            <p>Menu Restaurant</p>
        </a>

        <a href="lien/programme.php" class="card">
            <ion-icon name="book-outline"></ion-icon>
            <p>Programme des Cours</p>
        </a>

        <a href="lien/infirmerie.php" class="card">
            <ion-icon name="medkit-outline"></ion-icon>
            <p>Infirmerie</p>
        </a>

        <a href="lien/activite.php" class="card">
            <ion-icon name="football-outline"></ion-icon>
            <p>Activités Sportives</p>
        </a>
    </div>

    <!-- CAROUSEL -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../Etudiant/images/image1.png.jpg" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="../Etudiant/images/image2.jpg" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="../Etudiant/images/image3.jpg" class="d-block w-100">
            </div>
        </div>
    </div>

    <!-- RULES -->
    <div class="rules-box">
        <h2> Règles d'entrée en cité</h2>
        <ul>
            <li>Respect des horaires</li>
            <li>Carte étudiant obligatoire</li>
            <li>Silence après 22h</li>
            <li>Respect du matériel</li>
            <li>Visiteurs sous autorisation</li>
        </ul>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
