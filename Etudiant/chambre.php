<?php
require('../Actions/chambreActions.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ma chambre</title>
<style>
/* ======= Body ======= */
body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: linear-gradient(135deg, #f0f4ff, #f9fbff);
    margin: 0;
    padding: 30px;
}

/* ======= Titres ======= */
.page-title {
    text-align: center;
    font-size: 28px;
    color: #2c3e50;
    margin-bottom: 10px;
}

.subtitle {
    text-align: center;
    color: #7f8c8d;
    margin-bottom: 30px;
}

.section-title {
    text-align: center;
    font-size: 22px;
    color: #34495e;
    margin-bottom: 25px;
}

/* ======= Bloc info chambre ======= */
.chambre-info {
    max-width: 700px;
    margin: 0 auto 30px auto;
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.chambre-info p {
    background: #f4f6fa;
    padding: 12px;
    border-radius: 8px;
    font-size: 14px;
}

/* ======= Cartes occupants ======= */
.occupants {
    max-width: 1000px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
}

.card {
    background: #ffffff;
    border-radius: 14px;
    padding: 18px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

.card p {
    margin: 8px 0;
    font-size: 14px;
    color: #555;
}

.card strong {
    color: #2c3e50;
    font-size: 16px;
}

/* ======= Badge "Moi" ======= */
.badge-me {
    display: inline-block;
    margin-left: 6px;
    background: #27ae60;
    color: #fff;
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 20px;
}

/* ======= Message erreur ======= */
.error {
    text-align: center;
    color: #c0392b;
    font-weight: bold;
    margin-top: 50px;
}
</style>
</head>
<body>

<h1 class="page-title">Ma chambre</h1>
<p class="subtitle">Informations et occupants de la chambre</p>

<?php if (isset($messageErreur)): ?>
    <p class="error"><?= $messageErreur ?></p>
<?php else: ?>

<div class="chambre-info">
    <p><strong>Numéro :</strong> <?= htmlspecialchars($numero_chambre) ?></p>
    <p><strong>Capacité :</strong> <?= $capacite ?> personnes</p>
    <p><strong>Occupants :</strong> <?= count($occupants) ?> / <?= $capacite ?></p>
</div>

<h2 class="section-title">Occupants de la chambre</h2>

<div class="occupants">
<?php foreach ($occupants as $o): ?>
    <div class="card">
        <p>
            <strong><?= $o['Nom'] ?> <?= $o['Prenom'] ?></strong>
            <?php if ($o['Id_Etudiant'] == $_SESSION['etudiant']['Id_Etudiant']): ?>
                <span class="badge-me">(Moi)</span>
            <?php endif; ?>
        </p>
        <p>Niveau : <?= $o['Niveau'] ?></p>
        <p>Filière : <?= $o['Filiere'] ?></p>
        <p>Sexe : <?= $o['Sexe'] ?></p>
        <p>Téléphone : <?= $o['Telephone'] ?></p>
    </div>
<?php endforeach; ?>
</div>

<?php endif; ?>

</body>
</html>
