<?php
// Démarrer une session
session_start();

// Utilisation de la superglobale $_SESSION
// pour manipuler le contenu de la session
print_r($_SESSION);

// Ajouter une information dans la session
$_SESSION['prenom'] = "Nathanaël";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script 1</title>
</head>

<body>
    <h1>Script 1</h1>
</body>

</html>