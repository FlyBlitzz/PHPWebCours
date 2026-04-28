<?php
$montantAchat = 140;
$remise = 0.10;
// Tester si une remise est applicable
if ($montantAchat > 100) {
    $montantAchat *= 1 - $remise;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXO-PROMO</title>
</head>

<body>
    <p>Le montant final à payer est de <?= $montantAchat ?> €</p>
</body>

</html>