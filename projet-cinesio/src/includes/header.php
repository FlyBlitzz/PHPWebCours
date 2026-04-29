<?php
session_start();
$estConnecte = isset($_SESSION['utilisateur']);
?>
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
                    <?php if ($estConnecte): ?>
                        <li><a href="ajouter-film.php" <?= strpos($_SERVER['PHP_SELF'], 'ajouter-film.php') !== false ? 'class="active"' : '' ?>>Ajouter</a></li>
                        <li><a href="mes-films.php" <?= strpos($_SERVER['PHP_SELF'], 'mes-films.php') !== false ? 'class="active"' : '' ?>>Mes Films</a></li>
                    <?php else: ?>
                        <li><a href="inscription.php" <?= strpos($_SERVER['PHP_SELF'], 'inscription.php') !== false ? 'class="active"' : '' ?>>Inscription</a></li>
                        <li><a href="connexion.php" <?= strpos($_SERVER['PHP_SELF'], 'connexion.php') !== false ? 'class="active"' : '' ?>>Connexion</a></li>
                    <?php endif; ?>
                    <?php if ($estConnecte): ?>
                        <li class="utilisateur-navigation">
                            <span class="pseudo-utilisateur">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg>
                                <?= htmlspecialchars($_SESSION['utilisateur']['pseudo']) ?>
                            </span>
                        </li>
                    <?php endif; ?>
                    <?php if ($estConnecte): ?>
                        <li>
                            <a href="deconnexion.php" class="btn-deconnexion">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16" style="transform: rotate(90deg);">
                                    <path
                                        d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                    <path
                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li><a href="">Contact</a></li>

                </ul>
            </nav>
        </div>
    </header>
    <main>