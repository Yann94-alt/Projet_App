<?php
session_start();
require('database.php');

if(isset($_POST['Valider'])){
    if(!empty($_POST['ident']) && !empty($_POST['password'])){
        $ident = htmlspecialchars($_POST['ident']);
        $password = htmlspecialchars($_POST['password']);

        // Vérifier si l'étudiant existe
        $verifyIfUserExists = $bdd->prepare('SELECT * FROM Etudiant WHERE Id_Etudiant = ?');
        $verifyIfUserExists->execute([$ident]);

        if($verifyIfUserExists->rowCount() > 0){
            $UserInfos = $verifyIfUserExists->fetch();

            if(password_verify($password, $UserInfos['Mdp'])){
                // Authentification réussie
                $_SESSION['etudiant'] = [
                    'id' => $UserInfos['id'],
                    'Id_Etudiant' => $UserInfos['Id_Etudiant'],
                    'Nom' => $UserInfos['Nom'],
                    'Prenom' => $UserInfos['Prenom'],
                    'Niveau' => $UserInfos['Niveau'],
                    'Filiere' => $UserInfos['Filiere']
                ];

                header('Location: Etudiant/dashEtudiant.php');
                exit;
            } else {
                $errorMsg = "Mot de passe incorrect.";
            }
        } else {
            $errorMsg = "ID étudiant inexistant.";
        }
    } else {
        $errorMsg = "Veuillez remplir tous les champs.";
    }
}
?>
