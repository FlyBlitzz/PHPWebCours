<?php
$prenom = "Nathanaël";
$nom = "Villard";
$age = 18;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXO-PROFIL</title>
</head>

<body>
    <p><?= "Bonjour $prenom $nom, vous avez $age ans." ?></p>
    <p>Bonjour <?= "$prenom $nom" ?>, vous avez <?= $age ?> ans</p>
</body>

</html>