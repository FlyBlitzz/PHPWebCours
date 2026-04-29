<?php
require_once '../src/repositories/filmRepository.php';
require_once '../src/lib/functions.php';
include '../src/includes/header.php';

if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit;
}

// Variables pour le formulaire
$erreurs = [];
$succes = false;
$donneesFormulaire = [
    'titre' => '',
    'date_sortie' => '',
    'duree' => '',
    'synopsis' => '',
    'image' => '',
    'id_genre' => '',
    'id_pays' => ''
];

// Traitement de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donneesFormulaire = [
        'titre' => trim($_POST['titre'] ?? ''),
        'date_sortie' => trim($_POST['date_sortie'] ?? ''),
        'duree' => trim($_POST['duree'] ?? ''),
        'synopsis' => trim($_POST['synopsis'] ?? ''),
        'image' => trim($_POST['image'] ?? ''),
        'id_genre' => trim($_POST['id_genre'] ?? ''),
        'id_pays' => trim($_POST['id_pays'] ?? '')
    ];

    // Validation des données
    // Vérifier que tous les champs sont remplis
    if (empty($donneesFormulaire['titre'])) {
        $erreurs['titre'] = "Le titre du film est obligatoire.";
    } elseif (strlen($donneesFormulaire['titre']) < 2) {
        $erreurs['titre'] = "Le titre doit contenir au minimum 2 caractères.";
    }

    if (empty($donneesFormulaire['date_sortie'])) {
        $erreurs['date_sortie'] = "La date de sortie est obligatoire.";
    }

    if (empty($donneesFormulaire['duree'])) {
        $erreurs['duree'] = "La durée est obligatoire.";
    } elseif (!is_numeric($donneesFormulaire['duree']) || (int) $donneesFormulaire['duree'] <= 0) {
        $erreurs['duree'] = "La durée doit être un nombre entier supérieur à 0.";
    }

    if (empty($donneesFormulaire['synopsis'])) {
        $erreurs['synopsis'] = "Le synopsis est obligatoire.";
    } elseif (strlen($donneesFormulaire['synopsis']) < 10) {
        $erreurs['synopsis'] = "Le synopsis doit contenir au minimum 10 caractères.";
    }

    if (empty($donneesFormulaire['image'])) {
        $erreurs['image'] = "L'affiche web (URL de l'image) est obligatoire.";
    } elseif (!filter_var($donneesFormulaire['image'], FILTER_VALIDATE_URL)) {
        $erreurs['image'] = "L'affiche web doit être une URL valide.";
    }

    if (empty($donneesFormulaire['id_genre'])) {
        $erreurs['id_genre'] = "Le genre est obligatoire.";
    } elseif (!in_array($donneesFormulaire['id_genre'], array_column(findAllGenres(), 'id'))) {
        $erreurs['id_genre'] = "Le genre sélectionné n'est pas valide.";
    }

    if (empty($donneesFormulaire['id_pays'])) {
        $erreurs['id_pays'] = "Le pays est obligatoire.";
    } elseif (!in_array($donneesFormulaire['id_pays'], array_column(findAllPays(), 'id'))) {
        $erreurs['id_pays'] = "Le pays sélectionné n'est pas valide.";
    }

    // Si pas d'erreurs, insérer le film
    if (empty($erreurs)) {
        $donneesFormulaire['id_utilisateur'] = $_SESSION['utilisateur']['id'];
        $succesInsertion = insertFilm($donneesFormulaire);
        if ($succesInsertion) {
            $succes = true;
            $donneesFormulaire = [
                'titre' => '',
                'date_sortie' => '',
                'duree' => '',
                'synopsis' => '',
                'image' => '',
                'id_genre' => '',
                'id_pays' => ''
            ];
        } else {
            $erreurs['general'] = "Erreur lors de l'insertion du film en base de données.";
        }
    }
}

// Récupérer les genres et pays pour les listes déroulantes
$genres = findAllGenres();
$pays = findAllPays();
?>

<h2>Ajouter un nouveau film</h2>
<p class="intro">Veuillez renseigner les informations ci-dessous pour ajouter un film au catalogue CinéSIO.</p>

<section class="formulaire-section">
    <?php if ($succes): ?>
        <div class="message-succes">
            ✓ Le film a été ajouté avec succès au catalogue !
        </div>
    <?php endif; ?>

    <?php if (isset($erreurs['general'])): ?>
        <div class="message-erreur">
            <strong><?= htmlspecialchars($erreurs['general']) ?></strong>
        </div>
    <?php endif; ?>

    <form method="POST" class="formulaire">
        <div class="formulaire-groupe">
            <label for="titre">Titre du film <span class="requis">*</span></label>
            <input type="text" id="titre" name="titre" placeholder="Ex: Dune: Deuxième Partie"
                value="<?= htmlspecialchars($donneesFormulaire['titre']) ?>" required>
            <?= afficherErreurChamp('titre', $erreurs) ?>
        </div>

        <div class="formulaire-ligne">
            <div class="formulaire-groupe">
                <label for="date_sortie">Date de sortie <span class="requis">*</span></label>
                <input type="date" id="date_sortie" name="date_sortie"
                    value="<?= htmlspecialchars($donneesFormulaire['date_sortie']) ?>" required>
                <?= afficherErreurChamp('date_sortie', $erreurs) ?>
            </div>

            <div class="formulaire-groupe">
                <label for="duree">Durée (en minutes) <span class="requis">*</span></label>
                <input type="number" id="duree" name="duree" placeholder="Ex: 166"
                    value="<?= htmlspecialchars($donneesFormulaire['duree']) ?>" min="1" required>
                <?= afficherErreurChamp('duree', $erreurs) ?>
            </div>
        </div>

        <div class="formulaire-groupe">
            <label for="synopsis">Synopsis <span class="requis">*</span></label>
            <textarea id="synopsis" name="synopsis" placeholder="Le héros commence son périple..."
                required><?= htmlspecialchars($donneesFormulaire['synopsis']) ?></textarea>
            <?= afficherErreurChamp('synopsis', $erreurs) ?>
        </div>

        <div class="formulaire-groupe">
            <label for="image">Affiche web (URL de l'image) <span class="requis">*</span></label>
            <input type="url" id="image" name="image" placeholder="https://exemple.com/image.jpg"
                value="<?= htmlspecialchars($donneesFormulaire['image']) ?>" required>
            <?= afficherErreurChamp('image', $erreurs) ?>
        </div>

        <div class="formulaire-ligne">
            <div class="formulaire-groupe">
                <label for="id_genre">Genre <span class="requis">*</span></label>
                <select id="id_genre" name="id_genre" required>
                    <option value="">Sélectionnez un genre...</option>
                    <?php foreach ($genres as $genre): ?>
                        <option value="<?= $genre['id'] ?>" <?= $donneesFormulaire['id_genre'] == $genre['id'] ? 'selected' : '' ?>><?= htmlspecialchars($genre['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= afficherErreurChamp('id_genre', $erreurs) ?>
            </div>

            <div class="formulaire-groupe">
                <label for="id_pays">Pays <span class="requis">*</span></label>
                <select id="id_pays" name="id_pays" required>
                    <option value="">Sélectionnez un pays...</option>
                    <?php foreach ($pays as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= $donneesFormulaire['id_pays'] == $p['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($p['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?= afficherErreurChamp('id_pays', $erreurs) ?>
            </div>
        </div>

        <p class="formulaire-legende"><span class="requis">*</span> Champ obligatoire</p>

        <button type="submit" class="btn btn-envoyer">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle"
                viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
            </svg>
            Ajouter ce film au catalogue
        </button>
    </form>
</section>

<?php include '../src/includes/footer.php'; ?>