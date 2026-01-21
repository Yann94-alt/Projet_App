<?php
session_start();
require('../Actions/database.php');

if(!isset($_SESSION['etudiant'])){
    header('Location: ../login.php');
    exit;
}

$idEt = $_SESSION['etudiant']['id']; // clé primaire id

$messages = $bdd->prepare("SELECT message, date_envoi FROM messages WHERE id_etudiant = ? ORDER BY date_envoi DESC");
$messages->execute([$idEt]);
$messages = $messages->fetchAll();
?>

<div class="container mt-5">
    <h2>Mes messages</h2>
    <?php if(empty($messages)): ?>
        <p>Aucun message pour le moment.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach($messages as $msg): ?>
                <li class="list-group-item">
                    <strong><?= $msg['date_envoi'] ?> :</strong> <?= $msg['message'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
