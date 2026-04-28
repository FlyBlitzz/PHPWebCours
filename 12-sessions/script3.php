<?php
session_start();

// Supprimer le prénom de la session
unset($_SESSION['prenom']);

// Supprimer toutes les données de la session
// Ne supprime pas le fichier de session
$_SESSION = [];

// Supprimer le fichier de session
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script 3</title>
</head>

<body>
    <h1>Script 3</h1>
</body>

</html>