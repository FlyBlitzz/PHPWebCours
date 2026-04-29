<?php
require_once '../src/repositories/filmRepository.php';
require_once '../src/lib/functions.php';
include '../src/includes/header.php';

$filmRecherche = null;
$messageErreur = null;
$urlInvalide = "URL invalide";
$id = $_GET['id'] ?? '';

if ($id === '') {
    $titreErreur = $urlInvalide;
    $messageErreur = "Identifiant du film manquant.";
} elseif (filter_var($id, FILTER_VALIDATE_INT) === false) {
    $titreErreur = $urlInvalide;
    $messageErreur = "Identifiant doit être une valeur numérique.";
} elseif ($id <= 0) {
    $titreErreur = $urlInvalide;
    $messageErreur = "Identifiant doit être strictement positif.";
} else {
    $id = (int) $id;
    $filmRecherche = findFilmById($id);
    if ($filmRecherche === null) {
        $titreErreur = "Film introuvable";
        $messageErreur = "Le film recherché n'existe pas dans le catalogue.";
    }
}
?>

<a href="index.php" class="retour-catalogue">← Retour au catalogue</a>

<?php if ($filmRecherche !== null): ?>
    <div class="detail-film">
        <div class="detail-film-image">
            <img src="<?= htmlspecialchars($filmRecherche['image']) ?>"
                alt="<?= htmlspecialchars($filmRecherche['titre']) ?>">
        </div>
        <div class="detail-film-info">
            <div class="detail-header-meta flex-center">
                <div class="film-badge"><?= htmlspecialchars($filmRecherche['initiale_pays']) ?></div>
                <p class="detail-genre-annee flex-center">
                    <span class="separateur">•</span>
                    <span><?= htmlspecialchars($filmRecherche['genre']) ?></span>
                    <span class="separateur">•</span>
                    <span><?= substr(htmlspecialchars($filmRecherche['date_sortie']), 0, 4) ?></span>
                </p>
            </div>
            <h1 class="detail-titre titre"><?= htmlspecialchars($filmRecherche['titre']) ?></h1>
            <div class="detail-meta flex-center">
                <span class="icon-duree"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg></span>
                <span><?= convertirDuree($filmRecherche['duree']) ?></span>
            </div>
            <?php if ($filmRecherche['pseudo']): ?>
                <p class="detail-createur"><strong>Créé par :</strong> <?= htmlspecialchars($filmRecherche['pseudo']) ?></p>
            <?php endif; ?>
            <h3 class="synopsis-titre titre">Synopsis</h3>
            <p class="detail-synopsis"><?= htmlspecialchars($filmRecherche['synopsis']) ?></p>
            <a href="#" class="btn btn-verra-plus-tard">On verra plus tard...</a>
        </div>
    </div>
<?php else: ?>
    <div class="film-introuvable">
        <h2 class="titre"><?= htmlspecialchars($titreErreur) ?></h2>
        <p><?= htmlspecialchars($messageErreur) ?></p>
        <a href="index.php" class="btn">Explorer le catalogue</a>
    </div>
<?php endif; ?>

<?php include '../src/includes/footer.php'; ?>