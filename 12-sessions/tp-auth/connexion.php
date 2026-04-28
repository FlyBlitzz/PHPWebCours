<?php
session_start();

// Simuler la table utilisateurs
$utilisateurs = [
    [
        "login" => "alice@test.fr",
        "password" => "azerty123",
        "prenom" => "Alice",
        "nom" => "Dupond"
    ],
    [
        "login" => "bob@test.fr",
        "password" => "secret456",
        "prenom" => "Bob",
        "nom" => "Martin"
    ]
];

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Rechercher dans le tableau si un utilisateur existe
    $utilisateurTrouve = null;
    foreach ($utilisateurs as $utilisateur) {
        if ($utilisateur['login'] === $login && $utilisateur['password'] === $password) {
            $utilisateurTrouve = $utilisateur;
            break;
        }
    }

    // Test si l'utilisateur a été trouvé
    if ($utilisateurTrouve !== null) {
        // Informer PHP que je suis connecté
        $_SESSION['utilisateur'] = [
            "login" => $utilisateurTrouve['login'],
            "prenom" => $utilisateurTrouve['prenom'],
            "nom" => $utilisateurTrouve['nom']
        ];

        // On ne reste jamais sur la page du formulaire lorsque celui-ci a été soumis
        // Rediriger l'utilisateur vers une autre page du site
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <h1>Connexion</h1>

    <form action="connexion.php" method="post">
        <div>
            <label for="login">Login</label>
            <input type="text" id="login" name="login">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>

        <button type="submit">Se connecter</button>
    </form>
</body>

</html>