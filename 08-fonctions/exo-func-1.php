<?php
function appliquerRemise(float $prix, float $pourcentage): float
{
    $prixSolde = $prix - $prix * ($pourcentage / 100);
    return $prixSolde;
}

$pourcentage = 20;
$listePrix = [120.50, 150.00, 99.99];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice</title>
</head>

<body>
    <h1>Prix soldés</h1>
    <ul>
        <?php foreach ($listePrix as $prix): ?>
            <li><?= appliquerRemise($prix, $pourcentage) ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>