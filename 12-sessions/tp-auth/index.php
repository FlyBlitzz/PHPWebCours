<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page accueil</title>
</head>

<body>
    <h1>Accueil du site</h1>
    <!-- Tester si l'utilisateur est connecté -->
    <?php if (isset($_SESSION['utilisateur'])): ?>
        <p>Bonjour <?= $_SESSION['utilisateur']['prenom'] ?></p>
        <p><a href="page-protegee.php">Accès à profil</a></p>
        <p><a href="page-protegee2.php">Accès à mon espace protégé</a></p>
        <p><a href="deconnexion.php">Se déconnecter</a></p>
    <?php else: ?>
        <p>Vous n'êtes pas connecté.</p>
        <p><a href="connexion.php">Se connecter</a></p>
    <?php endif; ?>

</body>

</html>