<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciné SIO</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <div class="contenueur">
            <h1>
                <svg class="logo-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M3 4a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H3zm1 2h2v2H4V6zm0 4h2v2H4v-2zm0 4h2v2H4v-2zm14-8h2v2h-2V6zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2zM8 6h8v12H8V6z" />
                </svg>
                <span class="violet-gras">Ciné</span>SIO
            </h1>
            <nav>
                <ul>
                    <li><a href="index.php" <?= strpos($_SERVER['PHP_SELF'], 'index.php') !== false ? 'class="active"' : '' ?>>Accueil</a></li>
                    <li><a href="">Catalogue</a></li>
                    <li><a href="ajouter-film.php" <?= strpos($_SERVER['PHP_SELF'], 'ajouter-film.php') !== false ? 'class="active"' : '' ?>>Ajouter un film</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>