<?php
require('../../Actions/database.php');

if(isset($_POST['valider'])) {
    $numero = htmlspecialchars($_POST['numero']);
    $niveau = $_POST['niveau'];
    $sexe   = $_POST['sexe'];
    $filiere = $_POST['filiere'];
    $capacite = intval($_POST['capacite']);

    // Vérifier si la chambre existe déjà
    $check = $bdd->prepare("SELECT * FROM chambre WHERE numero_chambre = ?");
    $check->execute([$numero]);

    if($check->rowCount() > 0) {
        $errorMsg = "Cette chambre existe déjà !";
    } else {
        $insert = $bdd->prepare("INSERT INTO chambre (numero_chambre, niveau, sexe, capacite, filiere) VALUES (?, ?, ?, ?, ?)");
        $insert->execute([$numero, $niveau, $sexe, $capacite, $filiere]);
        $successMsg = "Chambre ajoutée avec succès !";
    }
}
?>
