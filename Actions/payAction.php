<?php
require('database.php'); // $bdd = PDO

if (isset($_POST['valider'])) {

    if (
        !empty($_POST['IdEt']) &&
        !empty($_POST['password']) &&
        !empty($_POST['name']) &&
        !empty($_POST['prenom']) &&
        !empty($_POST['sexe']) &&
        !empty($_POST['niveau']) &&
        !empty($_POST['filiere']) &&
        !empty($_POST['telephone'])
    ) {

        $IdEt      = htmlspecialchars($_POST['IdEt']);
        $nom       = htmlspecialchars($_POST['name']);
        $prenom    = htmlspecialchars($_POST['prenom']);
        $sexe      = $_POST['sexe']; // M ou F
        $niveau    = $_POST['niveau'];
        $filiere   = $_POST['filiere'];
        $telephone = htmlspecialchars($_POST['telephone']);
        $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Vérifier si l'étudiant existe déjà
        $check = $bdd->prepare("SELECT id FROM Etudiant WHERE Id_Etudiant = ?");
        $check->execute([$IdEt]);

        if ($check->rowCount() == 0) {

            $insert = $bdd->prepare("
                INSERT INTO Etudiant
                (Id_Etudiant, Mdp, Nom, Prenom, Sexe, Niveau, Filiere, Telephone, created_at)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
            ");

            $insert->execute([
                $IdEt,
                $password,
                $nom,
                $prenom,
                $sexe,
                $niveau,
                $filiere,
                $telephone
            ]);

            $successMsg = "Inscription réussie !";
            header('Location: login.php');
            exit;

        } else {
            $errorMsg = "Cet ID étudiant existe déjà.";
        }

    } else {
        $errorMsg = "Veuillez remplir tous les champs.";
    }
}
