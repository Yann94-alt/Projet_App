<?php
session_start();
require('database.php');

if (isset($_POST['Valider'])) {

    if (!empty($_POST['ident']) && !empty($_POST['password'])) {

        $ident = htmlspecialchars($_POST['ident']);
        $password = $_POST['password'];

        // Vérifier si l'étudiant existe
        $sql = $bdd->prepare("SELECT * FROM etudiant WHERE Id_Etudiant = ?");
        $sql->execute([$ident]);

        if ($sql->rowCount() > 0) {

            $UserInfos = $sql->fetch(PDO::FETCH_ASSOC);

            // Vérification du mot de passe
            if (password_verify($password, $UserInfos['Mdp'])) {

                // ✅ SESSION COMPLÈTE (TRÈS IMPORTANT)
                $_SESSION['etudiant'] = [
                    'id'           => $UserInfos['id'],
                    'Id_Etudiant'  => $UserInfos['Id_Etudiant'],
                    'Nom'          => $UserInfos['Nom'],
                    'Prenom'       => $UserInfos['Prenom'],
                    'Sexe'         => $UserInfos['Sexe'],        // M / F
                    'Niveau'       => $UserInfos['Niveau'],
                    'Filiere'      => $UserInfos['Filiere'],
                    'Telephone'    => $UserInfos['Telephone']
                ];

                // ✅ REDIRECTION CORRECTE (CHEMIN FIXÉ)
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
