<?php
session_start();

if (isset($_POST['Valider'])) {
    $ident = trim($_POST['ident']);
    $password = trim($_POST['password']);

    // Admin temporaire
    if ($ident === 'admin' && $password === 'admin') {
        $_SESSION['admin'] = ['nom_admin' => $ident];
        header('Location: Admin/dashAdmin.php');
        exit;
    } else {
        $errorMsg = "Nom ou mot de passe incorrect.";
    }
}
?>
