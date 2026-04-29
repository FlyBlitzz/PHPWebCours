<?php
include '../src/includes/header.php';
include '../src/database/connection.php';
include '../src/repositories/utilisateurRepository.php';
include '../src/lib/functions.php';

// Initialiser les variables
$erreurs = [];
$succes = false;
$email = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password_saisi = $_POST['password'] ?? '';

    // Validations
    if (empty($email)) {
        $erreurs['email'] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Le format de l'email n'est pas valide.";
    }

    if (empty($password_saisi)) {
        $erreurs['password'] = "Le mot de passe est requis.";
    }

    // Si pas d'erreurs, vérifier l'utilisateur
    if (empty($erreurs)) {
        $utilisateur = findUtilisateurByEmail($email);

        if ($utilisateur && password_verify($password_saisi, $utilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur'] = [
                'id' => $utilisateur['id'],
                'pseudo' => $utilisateur['pseudo']
            ];

            header('Location: index.php');
            exit;
        } else {
            $erreurs['email'] = "Email ou mot de passe incorrect.";
        }
    }
}
?>

<h2>Connexion</h2>
<p class="sous-titre">Accédez à votre espace membre CinéSIO.</p>
<div class="page-conteneur">
    <div class="formulaire-conteneur">

        <form class="connexion-formulaire" method="POST" action="">
            <div class="formulaire-groupe">
                <label for="email">Adresse Email</label>
                <input type="email" id="email" name="email" placeholder="votre@email.com"
                    value="<?= htmlspecialchars($email ?? '') ?>" required>
                <?= afficherErreurChamp('email', $erreurs) ?>
            </div>

            <div class="formulaire-groupe">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                <?= afficherErreurChamp('password', $erreurs) ?>
            </div>

            <button type="submit" class="btn-connexion">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"
                    style="transform: rotate(-90deg);">
                    <path
                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                    <path
                        d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                </svg>
                Se connecter
            </button>
        </form>

        <p class="lien-inscription">Pas encore de compte ? <a href="inscription.php">Créer un compte</a></p>
    </div>
</div>

<?php include '../src/includes/footer.php'; ?>