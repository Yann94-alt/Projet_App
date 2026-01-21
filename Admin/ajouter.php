<?php  
include('../head.php'); 
require('../Actions/ajouterActions.php');
?>

<div class="container mt-5" style="max-width: 800px;">

    <?php
    if(isset($errorMsg)){
        echo '<p class="text-center" style="color:#e57373;">'.$errorMsg.'</p>'; // rouge doux
    }
    if(isset($successMsg)){
        echo '<p class="text-center" style="color:#81c784;">'.$successMsg.'</p>'; // vert doux
    }
    ?>

    <form method="POST" class="border p-4 rounded shadow-sm" style="background-color: #f6f6f6; border-color: #ddd;">
        <h2 class="text-center mb-4" style="color: red;">
    <i class="ion-person-circle"></i> INSCRIPTION ÉTUDIANT
</h2>
        <div class="row">
            <!-- Bloc gauche -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">ID Étudiant</label>
                    <input type="text" class="form-control" name="IdEt" required style="border-radius: 5px; border:1px solid #ccc;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" required style="border-radius: 5px; border:1px solid #ccc;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sexe</label><br>
                    <input type="radio" name="sexe" value="M" required> M <br>
                    <input type="radio" name="sexe" value="F"> F
                </div>
            </div>

            <!-- Bloc droit -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input autocomplete="off" type="text" class="form-control" name="name" pattern="[A-Za-zÀ-ÿ\s\-]+" title="Le nom ne doit contenir que des lettres" required style="border-radius: 5px; border:1px solid #ccc;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" pattern="[A-Za-zÀ-ÿ\s\-]+" title="Le prénom ne doit contenir que des lettres" required style="border-radius: 5px; border:1px solid #ccc;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Niveau</label>
                    <select name="niveau" class="form-select" required style="border-radius: 5px; border:1px solid #ccc;">
                        <option value="">Choisir</option>
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                        <option value="M1">M1</option>
                        <option value="M2">M2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Filière</label>
                    <select name="filiere" class="form-select" required style="border-radius: 5px; border:1px solid #ccc;">
                        <option value="">Choisir</option>
                        <option value="Droit">Droit</option>
                        <option value="IGL">IGL</option>
                        <option value="SEG">SEG</option>
                        <option value="COM">COM</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="telephone" pattern="^\+?\d{8,15}$" title="Entrez un numéro valide" required style="border-radius: 5px; border:1px solid #ccc;">
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" name="valider" class="btn" style="background-color: #6699cc; color: white; border-radius:5px;">
                <i class="ion-person-add"></i> S'inscrire
            </button>
            <a href="gestion.php" class="btn" style="background-color: #b0b0b0; color: white; border-radius:5px; margin-left: 10px;">
                Retour
            </a>
        </div>
    </form>
</div>
