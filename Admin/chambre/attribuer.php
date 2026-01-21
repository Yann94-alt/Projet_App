<?php
include('../../head.php');
require('attribuerA.php');

// Récupérer les étudiants et chambres disponibles
$etudiants = $bdd->query("SELECT Id_Etudiant, Nom, Prenom FROM etudiant")->fetchAll();
$chambres  = $bdd->query("SELECT id_chambre, numero_chambre FROM chambre")->fetchAll();
?>

<div class="container mt-5" style="max-width: 500px;">
    <form method="POST" class="border p-4 rounded shadow-sm" style="background-color: #fafafa; border-color: #ddd;">

        <h2 class="text-center mb-4" style="color: #6a1b9a;">
            <i class="ion-home"></i> Attribuer une Chambre
        </h2>

        <!-- Sélection Étudiant -->
        <div class="mb-3">
            <select name="etudiant" class="form-select" required style="border-radius:5px; border:1px solid #ccc; padding:10px;">
                <option value="">-- Sélectionner Étudiant --</option>
                <?php foreach($etudiants as $et) : ?>
                    <option value="<?= $et['Id_Etudiant'] ?>"><?= $et['Nom'].' '.$et['Prenom'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sélection Chambre -->
        <div class="mb-3">
            <select name="chambre" class="form-select" required style="border-radius:5px; border:1px solid #ccc; padding:10px;">
                <option value="">-- Sélectionner Chambre --</option>
                <?php foreach($chambres as $ch) : ?>
                    <option value="<?= $ch['id_chambre'] ?>"><?= $ch['numero_chambre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Bouton -->
        <div class="text-center">
            <button type="submit" name="attribuer" class="btn btn-primary" style="background-color: #6a1b9a; color:white; padding:10px 20px; font-size:16px; border-radius:5px; border:none;">
                <i class="ion-checkmark"></i> Attribuer Chambre
            </button>
        </div>

        <!-- Message de succès -->
        <div class="mt-3 text-center">
            <?php
            if(isset($successMsg)) echo "<p style='color:#81c784;'>$successMsg</p>";
            ?>
        </div>
    </form>
</div>
