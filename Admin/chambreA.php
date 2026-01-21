<?php
include('../../head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Chambres</title>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
            background: #f5f5f5;
        }

        h1 {
            margin-bottom: 50px;
            color: #2c3e50;
        }

        .btn {
            font-size: 20px;
            padding: 20px 30px;
            margin: 20px; /* espace entre les boutons */
            border: none;  /* supprime toute bordure */
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none; /* pas de soulignement si <a> */
        }

        .btn-add {
            background-color: #27ae60; /* vert */
        }

        .btn-assign {
            background-color: #2980b9; /* bleu */
        }

        .btn:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>

    <h1>GESTION DES CHAMBRES</h1>

    <a href="chambre/ajouter.php" class="btn btn-add">
        <i class="ion-plus-circled"></i> Ajouter Chambre
    </a>

    <a href="chambre/attribuer.php" class="btn btn-assign">
        <i class="ion-ios-people"></i> Attribuer Chambre
    </a>

</body>
</html>
