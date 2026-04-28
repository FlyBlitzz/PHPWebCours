<?php
require_once __DIR__ . "/../database/connection.php";
function findAllFilms(): array
{
    $connexion = getConnexion();
    $requeteSQL = "SELECT film.id, film.titre, film.duree, film.synopsis, film.image, genre.nom as genre, pays.initiale as initiale_pays FROM film, genre, pays WHERE film.id_genre = genre.id AND film.id_pays = pays.id";
    $requete = $connexion->prepare($requeteSQL);
    $requete->execute();
    $film = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $film;
}

function findFilmById($id): ?array
{
    $connexion = getConnexion();
    $requeteSQL = "SELECT film.id, film.date_sortie, film.titre, film.duree, film.synopsis, film.image, genre.nom as genre, pays.initiale as initiale_pays FROM film, genre, pays WHERE film.id_genre = genre.id AND film.id_pays = pays.id AND film.id = :id";
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
    $requeteSQL = "INSERT INTO film (titre, date_sortie, duree, synopsis, image, id_genre, id_pays) 
                   VALUES (:titre, :date_sortie, :duree, :synopsis, :image, :id_genre, :id_pays)";

    $requete = $connexion->prepare($requeteSQL);

    $requete->bindValue(':titre', $filmData['titre']);
    $requete->bindValue(':date_sortie', $filmData['date_sortie']);
    $requete->bindValue(':duree', (int) $filmData['duree']);
    $requete->bindValue(':synopsis', $filmData['synopsis']);
    $requete->bindValue(':image', $filmData['image']);
    $requete->bindValue(':id_genre', (int) $filmData['id_genre']);
    $requete->bindValue(':id_pays', (int) $filmData['id_pays']);

    return $requete->execute();
}