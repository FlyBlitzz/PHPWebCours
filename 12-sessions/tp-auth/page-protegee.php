<?php
session_start();

// Vérifier que l'utilisateur est connecté
// S'il ne l'est pas, on le redirige vers la page de connexion

if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
</head>

<body>
    <h1>Mon profil</h1>
    <p>Vous êtes connecté avec le compte</p>
    <ul>
        <li>Login : <?= $_SESSION['utilisateur']['login'] ?></li>
        <li>Nom : <?= $_SESSION['utilisateur']['nom'] ?></li>
        <li>Prénom : <?= $_SESSION['utilisateur']['prenom'] ?></li>
    </ul>

    <p><a href="index.php">Retour à l'accueil</a></p>
</body>

</html>