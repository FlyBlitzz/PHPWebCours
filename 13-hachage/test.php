<?php

$password = "secret123";
// Calculer un hash du mot de passe
$hash = password_hash($password, PASSWORD_DEFAULT); // BCrypt
echo $hash;
/*$hash = password_hash($password, PASSWORD_DEFAULT); // BCrypt
echo PHP_EOL;
echo $hash;
echo PHP_EOL;
$hash = password_hash($password, PASSWORD_ARGON2I);
echo $hash;
*/
echo PHP_EOL;
// Vérifier un mot de passe
if (password_verify($password, $hash)) {
    echo "Le mot de passe est valide";
} else {
    echo "Le mot de passe est invalide";
}