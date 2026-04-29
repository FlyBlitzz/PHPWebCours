<?php
require_once '../src/repositories/filmRepository.php';
require_once '../src/lib/functions.php';
include '../src/includes/header.php';

if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit;
}

$films = findFilmsByUserId($_SESSION['utilisateur']['id']);
$nbFilms = count($films);
?>

<h2>Mes Films</h2>
<?php if ($nbFilms === 0): ?>
    <p class="intro">Vous n'avez pas encore créé de film dans le catalogue.</p>
    <p class="intro"><a href="ajouter-film.php" class="btn">Ajouter mon premier film</a></p>
<?php else: ?>
    <p class="intro">Vous avez créé <span class="violet-gras"><?= $nbFilms; ?></span>
        film<?php echo $nbFilms > 1 ? 's' : ''; ?> dans le catalogue.</p>
    <div class="films-grille">
        <?php foreach ($films as $film): ?>
            <div class="card">
                <div class="film-pays"><?= $film['initiale_pays'] ?></div>
                <img class="film-image" src="<?= $film['image'] ?>" alt="<?= $film['titre'] ?>">
                <div class="film-info">
                    <h3 class="film-titre"><?= $film['titre'] ?></h3>
                    <p class="film-meta"><?= $film['genre'] ?> <strong>·</strong> <?= convertirDuree($film['duree']) ?></p>
                    <p class="film-description"><?= substr($film['synopsis'], 0, 77) ?><?php if (strlen($film['synopsis']) > 77): ?>...<?php endif; ?></p>
                    <a href="detail-film.php?id=<?= $film['id'] ?>" class="btn btn-details">Détails</a>
                </div>
                </div>
        <?php endforeach; ?>
        </div>
<?php endif; ?>

<?php include '../src/includes/footer.php'; ?>