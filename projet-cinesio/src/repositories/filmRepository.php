<?php
require_once __DIR__ . "/../database/connection.php";
function findAllFilms(): array
{
    $connexion = getConnexion();
    $requeteSQL = "SELECT film.id, film.titre, film.duree, film.synopsis, film.image, genre.nom as genre, pays.initiale as initiale_pays, utilisateur.pseudo FROM film JOIN genre ON film.id_genre = genre.id JOIN pays ON film.id_pays = pays.id LEFT JOIN utilisateur ON film.id_utilisateur = utilisateur.id ORDER BY film.id ASC";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute();
    $film = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $film;
}

function findFilmById($id): ?array
{
    $connexion = getConnexion();
    $requeteSQL = "SELECT film.id, film.date_sortie, film.titre, film.duree, film.synopsis, film.image, genre.nom as genre, pays.initiale as initiale_pays, utilisateur.pseudo FROM film JOIN genre ON film.id_genre = genre.id JOIN pays ON film.id_pays = pays.id LEFT JOIN utilisateur ON film.id_utilisateur = utilisateur.id WHERE film.id = :id ORDER BY film.id ASC";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(':id', $id);
    $requete->execute();
    $film = $requete->fetch(PDO::FETCH_ASSOC);
    return $film === false ? null : $film;
}

function findAllGenres(): array
{
    $connexion = getConnexion();
    $requeteSQL = "SELECT id, nom FROM genre ORDER BY nom ASC";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute();
    $genres = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $genres;
}

function findAllPays(): array
{
    $connexion = getConnexion();
    $requeteSQL = "SELECT id, nom, initiale FROM pays ORDER BY nom ASC";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute();
    $pays = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $pays;
}

function insertFilm(array $filmData): bool
{
    $connexion = getConnexion();
    $requeteSQL = "INSERT INTO film (titre, date_sortie, duree, synopsis, image, id_genre, id_pays, id_utilisateur) 
                   VALUES (:titre, :date_sortie, :duree, :synopsis, :image, :id_genre, :id_pays, :id_utilisateur)";

    $requete = $connexion->prepare($requeteSQL);

    $requete->bindValue(':titre', $filmData['titre']);
    $requete->bindValue(':date_sortie', $filmData['date_sortie']);
    $requete->bindValue(':duree', (int) $filmData['duree']);
    $requete->bindValue(':synopsis', $filmData['synopsis']);
    $requete->bindValue(':image', $filmData['image']);
    $requete->bindValue(':id_genre', (int) $filmData['id_genre']);
    $requete->bindValue(':id_pays', (int) $filmData['id_pays']);
    $requete->bindValue(':id_utilisateur', isset($filmData['id_utilisateur']) ? (int) $filmData['id_utilisateur'] : null);

    return $requete->execute();
}

function findFilmsByUserId($userId): array
{
    $connexion = getConnexion();
    $requeteSQL = "SELECT film.id, film.titre, film.duree, film.synopsis, film.image, genre.nom as genre, pays.initiale as initiale_pays, utilisateur.pseudo FROM film JOIN genre ON film.id_genre = genre.id JOIN pays ON film.id_pays = pays.id LEFT JOIN utilisateur ON film.id_utilisateur = utilisateur.id WHERE film.id_utilisateur = :id_utilisateur ORDER BY film.id ASC";
    $requete = $connexion->prepare($requeteSQL);
    $requete->bindValue(':id_utilisateur', $userId);
    $requete->execute();
    $films = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $films;
}