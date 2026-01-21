<?php
session_start();

// Vérifie que l'étudiant est connecté
if (!isset($_SESSION['etudiant'])) {
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
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Paiement</title>
<style>
body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.payment-container {
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    max-width: 400px;
    width: 100%;
}

.payment-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #2c3e50;
}

.payment-container label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #34495e;
}

.payment-container input[type="number"],
.payment-container input[type="tel"] {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    box-sizing: border-box;
}

.payment-container button {
    width: 100%;
    padding: 12px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.2s;
}

.payment-container button:hover {
    background-color: #2980b9;
}
</style>
</head>
<body>

<div class="payment-container">
    <h2>Paiement</h2>

    <form action="../Actions/payAction.php" method="POST">
        <label for="tel">Numéro mobile pour le paiement :</label>   
         <input type="tel" name="tel" id="tel" required pattern="^\+?[0-9]{8,15}$" >
        <label for="montant">Montant à payer (FCFA) :</label>
        <input type="number" name="montant" id="montant"  required>

        <button type="submit">Payer</button>
    </form>
</div>

</body>
</html>


</body>
</html>
