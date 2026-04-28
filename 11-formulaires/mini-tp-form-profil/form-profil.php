<?php
// Tableau des statuts
$statutOptions = [
    '' => "-- Sélectionnez un statut --",
    "etudiant" => "Etudiant",
    "enseignant" => "Enseignant",
    "administratif" => "Administratif"
];

// Définir une variable par champs du formulaire
$pseudo = "";
$email = "";
$statut = "";
$erreurs = []; // Tableau associatif pour les erreurs
$succes = false;

// Détecter la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Le formulaire est soumis
    // récupérer chaque champs
    $pseudo = trim($_POST['pseudo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $statut = trim($_POST['statut'] ?? '');

    // Validation du pseudo
    if ($pseudo === '') {
        // Le pseudo n'a pas été saisi
        $erreurs['pseudo'] = "Le pseudo est obligatoire.";
    } elseif (mb_strlen($pseudo) < 3) {
        $erreurs['pseudo'] = "Le pseudo doit comporter au moins 3 caractères.";
    }

    // Validation de l'email
    if ($email === '') {
        $erreurs['email'] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs['email'] = "L'email n'est pas valide.";
    }

    // Validation du statut
    if ($statut === '') {
        $erreurs['statut'] = "Le statut est obligatoire.";
    } elseif (!array_key_exists($statut, $statutOptions)) {
        $erreurs['statut'] = "Le statut sélectionné n'est pas valide.";
    }

    // Traitement des données saisies
    // uniiquement dans le cas où il n'y a aucune erreur de validation
    if (empty($erreurs)) {
        $succes = true;
        // Réinitialiser les variables avec ''
        $pseudo = '';
        $email = '';
        $statut = '';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un profil</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <main class="page">

        <section class="card">
            <h1>Créer un profil</h1>
            <hr>

            <!-- Message de succès de la soumission et du traitement des données -->
            <?php if ($succes): ?>
                <div class="succes-message">
                    Le profil a été créé avec succès !
                </div>
            <?php endif; ?>
            <form action="" method="post" autocomplete="off" novalidate>

                <!-- PSEUDO -->
                <div class="champs">
                    <label for="pseudo">Pseudo <span>*</span> :</label>
                    <input id="pseudo" name="pseudo" type="text" placeholder="Ex: FL39" value="<?= $pseudo ?>" required
                        minlength="3">
                    <!-- Afficher l'erreur si il y en a une -->
                    <?php if (isset($erreurs['pseudo'])): ?>
                        <div class="erreur-message"><?= $erreurs['pseudo'] ?></div>
                    <?php endif; ?>
                    <small>3 caractères minimum</small>
                </div>

                <!-- EMAIL -->
                <div class="champs">
                    <label for="email">Email <span>*</span> :</label>
                    <input id="email" name="email" type="email" placeholder="votre@email.fr" value="<?= $email ?>"
                        required>
                    <!-- Afficher l'erreur si il y en a une -->
                    <?php if (isset($erreurs['email'])): ?>
                        <div class="erreur-message"><?= $erreurs['email'] ?></div>
                    <?php endif; ?>
                </div>

                <!-- STATUT -->
                <div class="champs">
                    <label for="statut">Statut <span>*</span> :</label>
                    <select id="statut" name="statut" value="<?= $statut ?>" required>
                        <!-- remplissage dynamique des options -->
                        <?php foreach ($statutOptions as $valeur => $libelle): ?>
                            <option value="<?= $valeur ?>" <?= $statut === $valeur ? 'selected' : '' ?>>
                                <?= $libelle ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!-- Afficher l'erreur si il y en a une -->
                    <?php if (isset($erreurs['statut'])): ?>
                        <div class="erreur-message"><?= $erreurs['statut'] ?></div>
                    <?php endif; ?>
                </div>

                <p class="indice">Le caractère <span class="requis">*</span> indique un champ obligatoire.</p>

                <button type="submit">
                    Créer profil
                </button>
            </form>
        </section>
    </main>
</body>

</html>