<?php
$estConnecte = false;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php if ($estConnecte): ?>
        <button>Déconnexion</button>
    <?php else: ?>
        <button>Se connecter</button>
    <?php endif; ?>
</body>

</html>