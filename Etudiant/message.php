<?php
session_start();

if (!isset($_SESSION['etudiant'])) {
    header('Location: ../login.php');
    exit;
}

$etudiant = $_SESSION['etudiant'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Envoyer un message</title>
<style>
/* ======= Body ======= */
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* ======= Formulaire ======= */
.message-form {
    background: #fff;
    padding: 20px 25px;       /* un peu moins pour simplifier */
    border-radius: 10px;      /* coins arrondis simples */
    box-shadow: 0 5px 15px rgba(0,0,0,0.1); /* ombre légère */
    width: 400px;
}

.message-form h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #2c3e50;
}

/* ======= Labels ======= */
.message-form label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
}

/* ======= Champs ======= */
.message-form input[type="text"],
.message-form textarea,
.message-form input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;     /* un peu moins pour plus d'espace */
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    box-sizing: border-box;
}

/* ======= Texte area ======= */
.message-form textarea {
    height: 100px;           /* taille raisonnable */
    resize: vertical;         /* utilisateur peut redimensionner verticalement */
}

/* ======= Bouton ======= */
.message-form button {
    width: 100%;
    padding: 12px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 6px;      /* simple et moderne */
    font-size: 16px;
    cursor: pointer;
    transition: background 0.2s;
}

.message-form button:hover {
    background-color: #2980b9; /* léger effet hover */
}

</style>
</head>
<body>

<div class="message-form">
    <h2>Envoyer un message</h2>
    <form action="../Actions/messageAction.php" method="POST" enctype="multipart/form-data">
        <label for="objet">Objet :</label>
        <input type="text" id="objet" name="objet" placeholder="Entrez l'objet du message" required>

        <label for="contenu">Contenu :</label>
        <textarea id="contenu" name="contenu" placeholder="Écrivez votre message ici..." required></textarea>

        <label for="photo">Image :</label>
        <input type="file" id="photo" name="photo" accept="image/*">

        <button type="submit">Envoyer</button>
    </form>
</div>

</body>
</html>
