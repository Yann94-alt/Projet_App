<?php
require('../../Actions/database.php');

if(isset($_POST['attribuer'])) {
    $id_etudiant = intval($_POST['etudiant']);
    $id_chambre   = intval($_POST['chambre']);

    // Supprimer l'étudiant de sa chambre précédente
    $del = $bdd->prepare("UPDATE etudiant SET id_chambre = NULL WHERE Id_Etudiant = ?");
    $del->execute([$id_etudiant]);

    // Attribuer la nouvelle chambre
    $assign = $bdd->prepare("UPDATE etudiant SET id_chambre = ? WHERE Id_Etudiant = ?");
    $assign->execute([$id_chambre, $id_etudiant]);

    $successMsg = "Chambre attribuée avec succès !";
}
?>
