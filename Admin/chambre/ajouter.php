<?php
include('../../head.php');
require('ajouterA.php');
?>

<div class="container mt-5" style="max-width: 500px;">
    <form method="POST" class="border p-4 rounded shadow-sm" style="background-color: #fafafa; border-color: #ddd;">

        <h2 class="text-center mb-4" style="color: #6a1b9a;">
            <i class="ion-person-circle"></i> Ajouter une Chambre
        </h2>

        <!-- Numéro de la chambre -->
        <div class="mb-3">
            <input type="text" name="numero" placeholder="Numéro de la chambre" class="form-control" required style="border-radius:5px; border:1px solid #ccc; padding:10px;">
        </div>

        <!-- Niveau -->
        <div class="mb-3">
            <select name="niveau" class="form-select" required style="border-radius:5px; border:1px solid #ccc; padding:10px;">
                <option value="">-- Niveau --</option>
                <option value="L1">L1</option>
                <option value="L2">L2</option>
                <option value="L3">L3</option>
                <option value="M1">M1</option>
                <option value="M2">M2</option>
            </select>
        </div>

        <!-- Sexe -->
        <div class="mb-3">
            <select name="sexe" class="form-select" required style="border-radius:5px; border:1px solid #ccc; padding:10px;">
                <option value="">-- Sexe --</option>
                <option value="M">M</option>
                <option value="F">F</option>
            </select>
        </div>

        <!-- Filière -->
        <div class="mb-3">
            <select name="filiere" class="form-select" required style="border-radius:5px; border:1px solid #ccc; padding:10px;">
                <option value="">-- Filière --</option>
                <option value="IGL">IGL</option>
                <option value="SEG">SEG</option>
                <option value="Droit">Droit</option>
                <option value="COM">COM</option>
            </select>
        </div>

        <!-- Capacité -->
        <div class="mb-3">
            <input type="number" name="capacite" placeholder="Capacité" min="1" required class="form-control" style="border-radius:5px; border:1px solid #ccc; padding:10px;">
        </div>

        <!-- Bouton -->
        <div class="text-center">
            <button type="submit" name="valider" class="btn btn-primary" style="background-color: #6a1b9a; color:white; padding:10px 20px; font-size:16px; border-radius:5px; border:none;">
                <i class="ion-plus"></i> Ajouter Chambre
            </button>
        </div>

        <!-- Messages -->
        <div class="mt-3 text-center">
            <?php
            if(isset($errorMsg)) echo "<p style='color:#e57373;'>$errorMsg</p>";
            if(isset($successMsg)) echo "<p style='color:#81c784;'>$successMsg</p>";
            ?>
        </div>
    </form>
</div>
