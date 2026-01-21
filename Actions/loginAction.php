<?php
// DÉMARRAGE SESSION (OBLIGATOIRE)
session_start();

// CONNEXION BASE DE DONNÉES
require('database.php');

// TRAITEMENT DU FORMULAIRE
if (isset($_POST['Valider'])) {

    if (!empty($_POST['ident']) && !empty($_POST['password'])) {

        $ident    = trim($_POST['ident']);      // ID étudiant
        $password = $_POST['password'];          // mot de passe saisi

        // RECHERCHE DE L'ÉTUDIANT
        $sql = $bdd->prepare("SELECT * FROM etudiant WHERE Id_Etudiant = ?");
        $sql->execute([$ident]);

        if ($sql->rowCount() === 1) {

            $UserInfos = $sql->fetch(PDO::FETCH_ASSOC);

            // VÉRIFICATION DU MOT DE PASSE
            if (password_verify($password, $UserInfos['Mdp'])) {

                // STOCKAGE DES INFOS EN SESSION
                $_SESSION['etudiant'] = [
                    'id'           => $UserInfos['id'],
                    'Id_Etudiant'  => $UserInfos['Id_Etudiant'],
                    'Nom'          => $UserInfos['Nom'],
                    'Prenom'       => $UserInfos['Prenom'],
                    'Sexe'         => $UserInfos['Sexe'],
                    'Niveau'       => $UserInfos['Niveau'],
                    'Filiere'      => $UserInfos['Filiere'],
                    'Telephone'    => $UserInfos['Telephone']
                ];

                // REDIRECTION
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
