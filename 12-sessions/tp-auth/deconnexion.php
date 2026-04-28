<?php

session_start();

// Supprimer dans la session les informations liées à la connexion
// de l'utilisateur => la clé 'utilisateur' dans $_SESSION
unset($_SESSION['utilisateur']);

// $_SESSION = [];
// session_destroy(); // Supprimer le fichier de la session sur le serveur
// Supprimer le cookie de session sur le navigateur

// Redirection vers index.php
header("Location: index.php");
exit;