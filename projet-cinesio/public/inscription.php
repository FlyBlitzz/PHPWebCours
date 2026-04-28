<?php
include '../src/includes/header.php';
include '../src/database/connection.php';
include '../src/repositories/utilisateurRepository.php';
include '../src/lib/functions.php';

// Initialiser les variables
$erreurs = [];
$succes = false;
$email = '';
$pseudonyme = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pseudonyme = trim($_POST['pseudonyme'] ?? '');
    $mot_de_passe = $_POST['password'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';

    // Validations
    if (empty($email)) {
        $erreurs['email'] = "L'email est requis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "Le format de l'email n'est pas valide.";
    } elseif (findUtilisateurByEmail($email)) {
        $erreurs['email'] = "Cet email est déjà utilisé.";
    }

    if (empty($pseudonyme)) {
        $erreurs['pseudonyme'] = "Le pseudonyme est requis.";
    } elseif (strlen($pseudonyme) < 3) {
        $erreurs['pseudonyme'] = "Le pseudonyme doit contenir au moins 3 caractères.";
    } elseif (findUtilisateurByPseudo($pseudonyme)) {
        $erreurs['pseudonyme'] = "Ce pseudonyme est déjà utilisé.";
    }

    if (empty($mot_de_passe)) {
        $erreurs['password'] = "Le mot de passe est requis.";
    } elseif (strlen($mot_de_passe) < 8) {
        $erreurs['password'] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    if (empty($confirmation)) {
        $erreurs['confirmation'] = "La confirmation du mot de passe est requise.";
    } elseif ($mot_de_passe !== $confirmation) {
        $erreurs['confirmation'] = "Le mot de passe et sa confirmation ne sont pas identiques.";
    }

    // Si pas d'erreurs, créer l'utilisateur
    if (empty($erreurs)) {
        $motDePasseHashe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $resultat = createUtilisateur([
            'pseudo' => $pseudonyme,
            'email' => $email,
            'mot_de_passe' => $motDePasseHashe
        ]);

        if ($resultat) {
            $succes = true;
            $email = '';
            $pseudonyme = '';
        } else {
            $erreurs['general'] = "Une erreur est survenue lors de la création du compte. Veuillez réessayer.";
        }
    }
}
?>

<h2>Créer un compte</h2>
<p class="sous-titre">Rejoignez la communauté CinéSIO pour accéder à toutes les fonctionnalités.</p>
<div class="page-conteneur">
    <div class="formulaire-conteneur">

        <?php if (isset($erreurs['general'])): ?>
            <div class="message-erreur">
                <strong><?= htmlspecialchars($erreurs['general']) ?></strong>
            </div>
        <?php endif; ?>

        <?php if ($succes): ?>
            <div class="message-succes">
                ✓ Compte créé avec succès ! Vous pouvez maintenant vous <a href="connexion.php">connecter</a>.
            </div>
        <?php endif; ?>

        <form class="inscription-formulaire" method="POST" action="">
            <div class="formulaire-groupe">
                <label for="email">Adresse Email <span class="requis">*</span></label>
                <input type="email" id="email" name="email" placeholder="Ex: jean.dupont@email.com"
                    value="<?= htmlspecialchars($email ?? '') ?>" required>
                <?= afficherErreurChamp('email', $erreurs) ?>
            </div>

            <div class="formulaire-groupe">
                <label for="pseudonyme">Pseudonyme <span class="requis">*</span></label>
                <input type="text" id="pseudonyme" name="pseudonyme" placeholder="Ex: JeanD88"
                    value="<?= htmlspecialchars($pseudonyme ?? '') ?>" required minlength="3">
                <small>3 caractères minimum.</small>
                <?= afficherErreurChamp('pseudonyme', $erreurs) ?>
            </div>

            <div class="formulaire-ligne">
                <div class="formulaire-groupe">
                    <label for="password">Mot de passe <span class="requis">*</span></label>
                    <input type="password" id="password" name="password" required minlength="8">
                    <small>8 caractères minimum.</small>
                    <?= afficherErreurChamp('password', $erreurs) ?>
                </div>

                <div class="formulaire-groupe">
                    <label for="confirmation">Confirmation <span class="requis">*</span></label>
                    <input type="password" id="confirmation" name="confirmation" required>
                    <?= afficherErreurChamp('confirmation', $erreurs) ?>
                </div>
            </div>

            <p class="formulaire-legende"><span class="requis">*</span> Champ obligatoire</p>

            <button type="submit" class="btn-inscription">M'inscrire maintenant</button>
        </form>

        <p class="lien-connexion">Déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
    </div>
</div>

<?php include '../src/includes/footer.php'; ?>