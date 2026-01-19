<?php
session_start();
require('../Actions/database.php');
require('../Actions/payAction.php'); // Connexion à la BDD

// Vérifie que l'étudiant est connecté
if(!isset($_SESSION['etudiant'])){
    header('Location: ../login.php');
    exit;
}

$etudiant = $_SESSION['etudiant'];
?>
<?php include '../head.php'  ?>

<!-- Wrapper pour centrer -->
<div class="d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="container" style="max-width:500px;">
        <h2 class="text-center mb-4">Paiement des frais de cité</h2>
        <form action="verif.php" method="POST" class="p-4 border rounded shadow-sm bg-light">
            <div class="mb-3">
                <label>Numéro de Paiement</label>
                <input type="text" name="id_etudiant" class="form-control" required >
            </div>

            <div class="mb-3">
                <label>Montant à payer </label>
                <input type="number" name="montant" class="form-control" required min="0" step="0.01">
            </div>

            <button type="submit" class="btn btn-primary w-100">Payer</button>
        </form>
    </div>
</div>
