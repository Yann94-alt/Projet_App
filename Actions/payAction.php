<?php
session_start();
require('database.php');

// Vérifier la connexion
if (!isset($_SESSION['etudiant'])) {
    header('Location: ../login.php');
    exit;
}

if (!isset($_POST['montant'])) {
    header('Location: ../Etudiant/pay.php');
    exit;
}

$etudiant = $_SESSION['etudiant'];

$idEt      = $etudiant['Id_Etudiant'];
$nom       = $etudiant['Nom'];
$prenom    = $etudiant['Prenom'];
$niveau    = $etudiant['Niveau'];
$sexe      = strtoupper(trim($etudiant['Sexe']));
$filiere   = $etudiant['Filiere'];
$telephone = $etudiant['Telephone'];

$montant = floatval($_POST['montant']);

// 🔢 Montant total fixé
$montantTotal = 750000;
$resteAPayer  = $montantTotal - $montant;

if ($montant < 350000) {
    die("Montant minimum : 350 000 FCFA");
}

/* =====================
   RECHERCHE DE CHAMBRE
   ===================== */
$sql = $bdd->prepare("
    SELECT c.id_chambre, c.numero_chambre, c.capacite,
           COUNT(e.Id_Etudiant) AS nb_etudiants
    FROM chambre c
    LEFT JOIN etudiant e ON c.id_chambre = e.id_chambre
    WHERE c.niveau = ?
      AND c.sexe = ?
      AND c.filiere = ?
    GROUP BY c.id_chambre
    HAVING nb_etudiants < c.capacite
    LIMIT 1
");
$sql->execute([$niveau, $sexe, $filiere]);
$chambre = $sql->fetch(PDO::FETCH_ASSOC);

if (!$chambre) {
    die("Aucune chambre disponible pour votre niveau / sexe / filière.");
}

$id_chambre = $chambre['id_chambre'];
$numero_chambre = $chambre['numero_chambre'];

/* =====================
   NUMÉRO DE LOGEMENT
   ===================== */
$logement = strtoupper(substr($nom, 0, 3))
          . strtoupper(substr($prenom, 0, 2))
          . substr($telephone, -3);

/* =====================
   MISE À JOUR ÉTUDIANT
   ===================== */
$upd = $bdd->prepare("
    UPDATE etudiant
    SET id_chambre = ?, numero_logement = ?
    WHERE Id_Etudiant = ?
");
$upd->execute([$id_chambre, $logement, $idEt]);

/* =====================
   ENREGISTRER PAIEMENT
   ===================== */
$pay = $bdd->prepare("
    INSERT INTO paiement (Id_Etudiant, montant, date_paiement)
    VALUES (?, ?, NOW())
");
$pay->execute([$idEt, $montant]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Reçu de paiement</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f0f2f5;
    min-height: 100vh;
    margin: 0;
    padding: 20px;
}

.receipt {
    max-width: 420px;
    margin: auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    padding: 25px;
}

.logo {
    text-align: center;
    margin-bottom: 15px;
}

.logo img {
    max-width: 140px;
}

.receipt h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
}

.receipt p {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    margin: 0;
    border-bottom: 1px dashed #ddd;
    font-size: 14px;
}

.receipt p:last-child {
    border-bottom: none;
}

.label {
    color: #666;
}

.value {
    font-weight: bold;
    color: #333;
}

.amount {
    margin-top: 20px;
    background: #f8f9fa;
    padding: 20px;
    border-left: 4px solid #3498db;
    border-radius: 8px;
    text-align: center;
}

.amount .title {
    color: #666;
}

.amount .price {
    font-size: 26px;
    font-weight: bold;
    color: #3498db;
}

.reste {
    margin-top: 15px;
    text-align: center;
    font-weight: bold;
    color: #c0392b;
}

@media print {
    body {
        background: white;
    }
}
</style>
</head>

<body>

<div class="receipt">

    <!-- LOGO -->
    <div class="logo">
        <img src="../Etudiant/images/R.jpg" alt="Logo">
    </div>

    <h2>Reçu de paiement</h2>

    <p><span class="label">Nom :</span><span class="value"><?= $nom . ' ' . $prenom ?></span></p>
    <p><span class="label">Identifiant :</span><span class="value"><?= $idEt ?></span></p>
    <p><span class="label">Niveau :</span><span class="value"><?= $niveau ?></span></p>
    <p><span class="label">Filière :</span><span class="value"><?= $filiere ?></span></p>
    <p><span class="label">Chambre :</span><span class="value"><?= $numero_chambre ?></span></p>
    <p><span class="label">Numéro logement :</span><span class="value"><?= $logement ?></span></p>
    <p><span class="label">Date :</span><span class="value"><?= date('d/m/Y') ?></span></p>

    <p><span class="label">Montant total :</span><span class="value"><?= number_format($montantTotal, 0, ',', ' ') ?> FCFA</span></p>
    <p><span class="label">Montant versé :</span><span class="value"><?= number_format($montant, 0, ',', ' ') ?> FCFA</span></p>

    <div class="reste">
        Reste à payer : <?= number_format($resteAPayer, 0, ',', ' ') ?> FCFA
    </div>

    <div class="amount">
        <div class="title">Versement effectué</div>
        <div class="price"><?= number_format($montant, 0, ',', ' ') ?> FCFA</div>
    </div>

</div>

</body>
</html>
