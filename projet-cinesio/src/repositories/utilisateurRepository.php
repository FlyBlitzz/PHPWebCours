<?php

function findUtilisateurByEmail(string $email) {
    $connexion = getConnexion();
    $requeteSQL = "SELECT id, pseudo, email, mot_de_passe FROM utilisateur WHERE email = :email";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute(['email' => $email]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function findUtilisateurByPseudo(string $pseudo) {
    $connexion = getConnexion();
    $requeteSQL = "SELECT id, pseudo, email, mot_de_passe FROM utilisateur WHERE pseudo = :pseudo";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute(['pseudo' => $pseudo]);
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function createUtilisateur(array $data) {
    $connexion = getConnexion();
    $requeteSQL = "INSERT INTO utilisateur (pseudo, email, mot_de_passe) VALUES (:pseudo, :email, :mot_de_passe)";
    $requete = $connexion->prepare($requeteSQL);
    return $requete->execute([
        'pseudo' => $data['pseudo'],
        'email' => $data['email'],
        'mot_de_passe' => $data['mot_de_passe']
    ]);
}