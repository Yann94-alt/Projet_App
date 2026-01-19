<?php  
include('head.php'); 
require('actions/signupAction.php');
?>

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<div class="container mt-5" style="max-width: 800px;">

    <?php
    if(isset($errorMsg)){
        echo '<p class="text-danger text-center">'.$errorMsg.'</p>';
    }
    if(isset($successMsg)){
        echo '<p class="text-success text-center">'.$successMsg.'</p>';
    }
    ?>

    <form method="POST" class="border p-4 rounded shadow-sm bg-light">
        <h2 class="text-center mb-4">
            <i class="ion-person-add"></i> INSCRIPTION ÉTUDIANT
        </h2>

        <div class="row">
            <!-- Bloc gauche -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">ID Étudiant</label>
                    <input type="text" class="form-control" name="IdEt" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" required>
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
                    <input type="text" class="form-control" name="name" pattern="[A-Za-zÀ-ÿ\s\-]+" title="Le nom ne doit contenir que des lettres" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" pattern="[A-Za-zÀ-ÿ\s\-]+" title="Le prénom ne doit contenir que des lettres" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Niveau</label>
                    <select name="niveau" class="form-select" required>
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
                    <select name="filiere" class="form-select" required>
                        <option value="">Choisir</option>
                        <option value="Droit">Droit</option>
                        <option value="IGL">IGL</option>
                        <option value="SEG">SEG</option>
                        <option value="COM">COM</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="telephone" pattern="^\+?\d{8,15}$" title="Entrez un numéro valide" required>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" name="valider" class="btn btn-primary">
                <i class="ion-person-add"></i> S'inscrire
            </button>
            <a href="login.php" class="btn btn-secondary ms-2">Retour</a>
        </div>
    </form>
</div>
