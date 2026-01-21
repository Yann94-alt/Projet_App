<?php
// chambreActions.php
session_start();
require('database.php');

// sécurité
if (!isset($_SESSION['etudiant'])) {
    header('Location: ../login.php');
    exit;
}

$etudiant   = $_SESSION['etudiant'];
$idEtudiant = $etudiant['Id_Etudiant'];

/* ==========================
   CHAMBRE DE L'ÉTUDIANT
   ========================== */
$stmt = $bdd->prepare("
    SELECT c.id_chambre, c.numero_chambre, c.capacite
    FROM chambre c
    JOIN etudiant e ON e.id_chambre = c.id_chambre
    WHERE e.Id_Etudiant = ?
");
$stmt->execute([$idEtudiant]);
$chambre = $stmt->fetch();

if (!$chambre) {
    $messageErreur = "Aucune chambre attribuée.";
    return;
}

$id_chambre     = $chambre['id_chambre'];
$numero_chambre = $chambre['numero_chambre'];
$capacite       = $chambre['capacite'];

/* ==========================
   OCCUPANTS DE LA CHAMBRE
   ========================== */
$req = $bdd->prepare("
    SELECT Id_Etudiant, Nom, Prenom, Niveau, Filiere, Sexe, Telephone
    FROM etudiant
    WHERE id_chambre = ?
    ORDER BY Nom
");
$req->execute([$id_chambre]);
$occupants = $req->fetchAll();
