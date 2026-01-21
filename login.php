<?php require('Actions/loginAction.php'); ?>
<?php require('Actions/loginAdmin.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include('head.php'); ?>
    <style>
        /* Background bleu moderne */
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        /* Form container */
        .login-container {
            width: 400px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.2);
            transition: all 0.5s ease;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Toggle switch Étudiant/Admin */
        .toggle-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            background: #f0f0f0;
            border-radius: 50px;
            padding: 5px;
            cursor: pointer;
        }
        .toggle-option {
            flex: 1;
            text-align: center;
            padding: 10px 0;
            border-radius: 50px;
            transition: all 0.3s ease;
            user-select: none;
            font-weight: 500;
            color: #333;
        }
        .toggle-option.active {
            background: #1e90ff; /* bleu vif pour active */
            color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        form {
            transition: opacity 0.4s ease, transform 0.4s ease;
        }
        form.d-none {
            opacity: 0;
            transform: translateY(-20px);
            height: 0;
            overflow: hidden;
        }

        /* Links at bottom */
        .login-links {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .login-links a.create {
            color: #1e90ff; /* bleu */
            text-decoration: none;
            font-weight: 500;
        }
        .login-links a.create:hover {
            text-decoration: underline;
        }
        .login-links a.forgot {
            color: #dc3545; /* rouge */
            text-decoration: none;
            font-weight: 500;
        }
        .login-links a.forgot:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Connexion</h2>

    <!-- Toggle Étudiant/Admin -->
    <div class="toggle-container">
        <div id="toggle-etudiant" class="toggle-option active">Étudiant</div>
        <div id="toggle-admin" class="toggle-option">Admin</div>
    </div>

    <!-- Formulaire Étudiant -->
    <form id="form-etudiant" method="POST">
        <input type="hidden" name="role" value="etudiant" />
        <?php if(isset($errorMsg)){ echo '<p class="error">'.$errorMsg.'</p>'; } ?>

        <div class="mb-3">
            <label for="etudiantIdentifiant" class="form-label">ID Étudiant</label>
            <input type="text" class="form-control" id="etudiantIdentifiant" name="ident" autocomplete="off" required>
        </div>
        <div class="mb-3">
            <label for="etudiantPassword" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="etudiantPassword" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100" name="Valider">Se connecter</button>
    </form>

    <!-- Formulaire Admin -->
    <form id="form-admin" method="POST" class="d-none mt-3">
        <input type="hidden" name="role" value="admin" />
        <div class="mb-3">
            <label for="adminNom" class="form-label">Nom Admin</label>
            <input type="text" class="form-control" id="adminNom" name="ident" required />
        </div>
        <div class="mb-3">
            <label for="adminPassword" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="adminPassword" name="password" required />
        </div>
        <button type="submit" class="btn btn-danger w-100" name="Valider">Se connecter</button>
    </form>

    <!-- Links bottom -->
    <div class="login-links">
        <a href="signup.php" class="create">Créer un compte</a>
        <a href="forgot.php" class="forgot">Mot de passe oublié ?</a>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const toggleEtudiant = document.getElementById('toggle-etudiant');
    const toggleAdmin = document.getElementById('toggle-admin');
    const formEtudiant = document.getElementById('form-etudiant');
    const formAdmin = document.getElementById('form-admin');

    toggleEtudiant.addEventListener('click', () => {
        formEtudiant.classList.remove('d-none');
        formAdmin.classList.add('d-none');

        toggleEtudiant.classList.add('active');
        toggleAdmin.classList.remove('active');
    });

    toggleAdmin.addEventListener('click', () => {
        formAdmin.classList.remove('d-none');
        formEtudiant.classList.add('d-none');

        toggleAdmin.classList.add('active');
        toggleEtudiant.classList.remove('active');
    });
</script>
</body>
</html>
