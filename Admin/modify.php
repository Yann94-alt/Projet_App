<?php
require('../Actions/database.php');
require('../Actions/ajouterActions.php'); // si tu as des fonctions communes

// Vérifie si l'ID est passé
if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: gestion.php");
    exit;
}

$id = $_GET['id'];

// Récupère les infos de l'étudiant
$sql = "SELECT * FROM etudiant WHERE Id_Etudiant = ?";
$stmt = $bdd->prepare($sql);
$stmt->execute([$id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$etudiant){
    header("Location: gestion.php");
    exit;
}

// Traitement du formulaire
if(isset($_POST['valider'])){
    $nom = $_POST['name'];
    $prenom = $_POST['prenom'];
    $sexe = $_POST['sexe'];
    $niveau = $_POST['niveau'];
    $filiere = $_POST['filiere'];
    $telephone = $_POST['telephone'];

    $sql = "UPDATE etudiant SET Nom=?, Prenom=?, Sexe=?, Niveau=?, Filiere=?, Telephone=? WHERE Id_Etudiant=?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nom, $prenom, $sexe, $niveau, $filiere, $telephone, $id]);

    $successMsg = "Étudiant modifié avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../head.php'; ?>
<body>

<div class="container mt-5" style="max-width: 800px;">
    <?php if(isset($successMsg)) echo '<p class="text-success text-center">'.$successMsg.'</p>'; ?>

    <form method="POST" class="border p-4 rounded shadow-sm bg-light">
        <h2 class="text-center mb-4">
            <i class="ion-edit"></i> MODIFIER ÉTUDIANT
        </h2>

        <div class="row">
            <!-- Bloc gauche -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($etudiant['Nom']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" value="<?= htmlspecialchars($etudiant['Prenom']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sexe</label><br>
                    <input type="radio" name="sexe" value="M" <?= ($etudiant['Sexe']=='M')?'checked':'' ?>> M
                    <input type="radio" name="sexe" value="F" <?= ($etudiant['Sexe']=='F')?'checked':'' ?>> F
                </div>
            </div>

            <!-- Bloc droit -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Niveau</label>
                    <select name="niveau" class="form-select" required>
                        <option value="L1" <?= ($etudiant['Niveau']=='L1')?'selected':'' ?>>L1</option>
                        <option value="L2" <?= ($etudiant['Niveau']=='L2')?'selected':'' ?>>L2</option>
                        <option value="L3" <?= ($etudiant['Niveau']=='L3')?'selected':'' ?>>L3</option>
                        <option value="M1" <?= ($etudiant['Niveau']=='M1')?'selected':'' ?>>M1</option>
                        <option value="M2" <?= ($etudiant['Niveau']=='M2')?'selected':'' ?>>M2</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Filière</label>
                    <select name="filiere" class="form-select" required>
                        <option value="Droit" <?= ($etudiant['Filiere']=='Droit')?'selected':'' ?>>Droit</option>
                        <option value="IGL" <?= ($etudiant['Filiere']=='IGL')?'selected':'' ?>>IGL</option>
                        <option value="SEG" <?= ($etudiant['Filiere']=='SEG')?'selected':'' ?>>SEG</option>
                        <option value="COM" <?= ($etudiant['Filiere']=='COM')?'selected':'' ?>>COM</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="telephone" value="<?= htmlspecialchars($etudiant['Telephone']) ?>" required>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" name="valider" class="btn btn-edit">
                <i class="ion-edit"></i> Modifier
            </button>
            <a href="gestion.php" class="btn btn-secondary ms-2"><i class="ion-arrow-left-a"></i> Retour</a>
        </div>
    </form>
</div>

</body>
</html>
