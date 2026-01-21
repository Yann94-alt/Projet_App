<?php
include('../head.php');
require('../Actions/database.php'); // connexion à la base

$montant_total = 750000; // montant total à payer

// Récupérer tous les étudiants avec total payé + niveau et filière
$etudiants = $bdd->query("
    SELECT e.id, e.Id_Etudiant, e.Nom, e.Prenom, e.Niveau, e.Filiere,
           COALESCE(SUM(p.montant),0) as montant_paye
    FROM etudiant e
    LEFT JOIN paiement p ON e.Id_Etudiant = p.Id_Etudiant
    GROUP BY e.id
")->fetchAll();

// Vérifier si un rappel doit être envoyé
if(isset($_POST['envoyer_message'])){
    $idEtudiantAlpha = $_POST['idEtudiant']; // ex: Yann1234

    // Récupérer l'id numérique réel
    $stmtId = $bdd->prepare("SELECT id FROM etudiant WHERE Id_Etudiant = ?");
    $stmtId->execute([$idEtudiantAlpha]);
    $idNumerique = $stmtId->fetchColumn();

    if($idNumerique){ // si on a trouvé l'étudiant
        // Calcul du montant payé
        $paiement = $bdd->prepare("SELECT COALESCE(SUM(montant),0) as total_paye FROM paiement WHERE Id_Etudiant=?");
        $paiement->execute([$idEtudiantAlpha]);
        $totalPaye = $paiement->fetch()['total_paye'];

        $restant = $montant_total - $totalPaye;

        if($restant > 0){
            $message = "Bonjour, vous êtes en retard de paiement. Il vous reste $restant FCFA à régler.";

            // Insérer dans messages
            $stmt = $bdd->prepare("INSERT INTO messages (id_etudiant, message, date_envoi) VALUES (?, ?, NOW())");
            $stmt->execute([$idNumerique, $message]);

            $successMsg = "Message envoyé à l'étudiant $idEtudiantAlpha (reste $restant FCFA)";
        }
    } else {
        $errorMsg = "Étudiant introuvable !";
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4" style="color:#6a1b9a;"><i class="ion-cash"></i> Gestion des Paiements</h2>

    <?php 
    if(isset($successMsg)) echo "<p class='text-center text-success'>$successMsg</p>"; 
    if(isset($errorMsg)) echo "<p class='text-center text-danger'>$errorMsg</p>"; 
    ?>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID Étudiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Niveau</th>
                <th>Filière</th>
                <th>Montant payé</th>
                <th>Montant restant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($etudiants as $et): ?>
            <?php $restant = $montant_total - $et['montant_paye']; ?>
            <tr>
                <td><?= $et['Id_Etudiant'] ?></td>
                <td><?= $et['Nom'] ?></td>
                <td><?= $et['Prenom'] ?></td>
                <td><?= $et['Niveau'] ?></td>
                <td><?= $et['Filiere'] ?></td>
                <td><?= number_format($et['montant_paye'],0,',',' ') ?> FCFA</td>
                <td style="color:<?= $restant > 0 ? 'red' : 'green' ?>;">
                    <?= number_format($restant,0,',',' ') ?> FCFA
                </td>
                <td>
                    <?php if($restant > 0): ?>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="idEtudiant" value="<?= $et['Id_Etudiant'] ?>">
                        <button type="submit" name="envoyer_message" class="btn btn-warning btn-sm">
                            <i class="ion-alert-circled"></i> Rappel
                        </button>
                    </form>
                    <?php else: ?>
                        <span class="text-success">Payé</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
