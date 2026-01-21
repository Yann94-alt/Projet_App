<?php
require('../Actions/database.php');

/* =========================
   RÉCUPÉRATION DES FILTRES
   ========================= */
$niveau  = $_GET['niveau'] ?? '';
$filiere = $_GET['filiere'] ?? '';

/* =========================
   REQUÊTE SIMPLE
   ========================= */
$sql = "
    SELECT 
        e.Id_Etudiant,
        e.Nom,
        e.Prenom,
        e.Sexe,
        e.Niveau,
        e.Filiere,
        e.Telephone,
        c.numero_chambre
    FROM etudiant e
    LEFT JOIN chambre c ON e.id_chambre = c.id_chambre
    WHERE 1=1
";

if (!empty($niveau)) {
    $sql .= " AND e.Niveau = '$niveau'";
}

if (!empty($filiere)) {
    $sql .= " AND e.Filiere = '$filiere'";
}

$req = $bdd->query($sql);
$etudiants = $req->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<?php include '../head.php'; ?>
<body>

<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 18px;
        background: #f4f6f9;
    }

    nav h1 {
        font-size: 32px;
        font-weight: bold;
        color: white;
        margin: 0;
    }

    .actions button, .actions a button {
        font-size: 18px;
        font-weight: bold;
        padding: 10px 18px;
        margin: 5px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        color: white;
        text-decoration: none;
    }

    .btn-add { background: #27ae60; }
    .btn-edit { background: #f39c12; }
    .btn-delete { background: #e74c3c; }

    .actions button:hover { opacity: 0.85; }

    select, button[type="submit"] {
        font-size: 18px;
        padding: 8px 14px;
        font-weight: bold;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    button[type="submit"] {
        background: #2980b9;
        color: white;
        border: none;
        cursor: pointer;
    }

    table {
        width: 95%;
        margin: auto;
        font-size: 18px;
        font-weight: bold;
        border-collapse: collapse;
        background: white;
    }

    th {
        background: #34495e;
        color: white;
        padding: 14px;
        font-size: 20px;
    }

    td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    
    .filters { text-align: center; margin-bottom: 20px; }
    .filters select, .filters button { margin: 0 5px; }
</style>

<nav style="text-align:center; padding:15px; background:#2c3e50;">
    <h1>GESTION DES ÉTUDIANTS</h1>
</nav>

<section class="actions" style="text-align:center; margin:20px;">
   <a href="ajouter.php"><button class="btn-add"><i class="ion-person-add"></i> Ajouter</button></a>
    <a href="dashAdmin"><button class="btn btn-secondary "></i> Retour</button></a>
</section>

<div class="filters">
    <form method="GET">
        <select name="niveau">
            <option value="">-- Niveau --</option>
            <option value="L1" <?= ($niveau=='L1')?'selected':'' ?>>L1</option>
            <option value="L2" <?= ($niveau=='L2')?'selected':'' ?>>L2</option>
            <option value="L3" <?= ($niveau=='L3')?'selected':'' ?>>L3</option>
            <option value="M1" <?= ($niveau=='M1')?'selected':'' ?>>M1</option>
            <option value="M2" <?= ($niveau=='M2')?'selected':'' ?>>M2</option>
        </select>

        <select name="filiere">
            <option value="">-- Filière --</option>
            <option value="IGL" <?= ($filiere=='IGL')?'selected':'' ?>>IGL</option>
            <option value="SEG" <?= ($filiere=='SEG')?'selected':'' ?>>SEG</option>
            <option value="Droit" <?= ($filiere=='Droit')?'selected':'' ?>>Droit</option>
            <option value="COM" <?= ($filiere=='COM')?'selected':'' ?>>COM</option>
        </select>

        <button type="submit">Rechercher</button>
    </form>
</div>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID Étudiant</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Sexe</th>
        <th>Niveau</th>
        <th>Filière</th>
        <th>Téléphone</th>
        <th>Chambre</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>

<?php if(!empty($etudiants)): ?>
    <?php foreach($etudiants as $et): ?>
        <tr>
            <td><?= $et['Id_Etudiant'] ?></td>
            <td><?= $et['Nom'] ?></td>
            <td><?= $et['Prenom'] ?></td>
            <td><?= $et['Sexe'] ?></td>
            <td><?= $et['Niveau'] ?></td>
            <td><?= $et['Filiere'] ?></td>
            <td><?= $et['Telephone'] ?></td>
            <td><?= $et['numero_chambre'] != '' ? $et['numero_chambre'] : 'Non attribuée' ?></td>
            <td>
                <a href="btn btn-secondary ms-2=<?= $et['Id_Etudiant'] ?>">
                    <button class="btn-edit"><i class="ion-edit"></i> Modifier</button>
                </a>
            </td>
            <td>
                <a href="delete.php?id=<?= $et['Id_Etudiant'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">
                    <button class="btn-delete"><i class="ion-trash-a"></i> Supprimer</button>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="10" style="text-align:center;">Aucun étudiant trouvé</td>
    </tr>
<?php endif; ?>
</table>

</body>
</html>
