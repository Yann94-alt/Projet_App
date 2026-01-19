<?php
session_start();
require('../Actions/database.php'); // Connexion à la BDD

if(!isset($_SESSION['etudiant'])){
    header('Location: ../login.php');
    exit;
}

$etudiant = $_SESSION['etudiant'];
$idEt = $etudiant['Id_Etudiant'];
$nom = htmlspecialchars($etudiant['Nom']);
$prenom = htmlspecialchars($etudiant['Prenom']);
$niveau = htmlspecialchars($etudiant['Niveau']);
$filiere = htmlspecialchars($etudiant['Filiere']);

if(isset($_POST['montant'])) {
    $montant = floatval($_POST['montant']);

    // Vérifier le montant minimum
    if($montant < 350){
        die("<p style='color:red;'>Le montant minimum est 350 €.</p>");
    }

    // Enregistrer le paiement
    $insertPaiement = $bdd->prepare("INSERT INTO paiements (id_etudiant, montant) VALUES (?, ?)");
    $insertPaiement->execute([$idEt, $montant]);

    // Générer un numéro de logement : 2 lettres du nom + 3 chiffres
    $logement = strtoupper(substr($nom,0,2)) . rand(100,999);

    // Générer un numéro de chambre aléatoire (exemple)
    $chambre = rand(1,200);

    // Attribuer chambre et logement
    $insertChambre = $bdd->prepare("INSERT INTO chambres (id_etudiant, numero_chambre, numero_logement) VALUES (?, ?, ?)");
    $insertChambre->execute([$idEt, $chambre, $logement]);

    // Afficher le reçu
    echo "<div style='max-width:600px;margin:50px auto;padding:20px;border:1px solid #ccc;border-radius:10px;text-align:center;'>";
    echo "<img src='../img/logo.png' alt='Logo' style='width:100px;margin-bottom:20px;'><h2>Reçu de paiement</h2>";
    echo "<p><strong>Nom :</strong> $nom $prenom</p>";
    echo "<p><strong>ID Étudiant :</strong> $idEt</p>";
    echo "<p><strong>Niveau :</strong> $niveau</p>";
    echo "<p><strong>Filière :</strong> $filiere</p>";
    echo "<p><strong>Numéro de chambre :</strong> $chambre</p>";
    echo "<p><strong>Numéro de logement :</strong> $logement</p>";
    echo "<p><strong>Montant payé :</strong> €$montant</p>";
    echo "<p><strong>Date :</strong> ".date('d/m/Y H:i')."</p>";
    echo "</div>";
}
?>
