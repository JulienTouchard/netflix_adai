<?php
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getInc("ConnectDB"));
class FilmRepository
{
    public function getFilmById($id)
    {
        $pdo = new ConnectDB;
        $rq = "SELECT * FROM movies_full WHERE id_movie = :id";
        $requete = $pdo->connect()->prepare($rq);
        $requete->bindValue(":id", $id, PDO::PARAM_INT);
        $requete->execute();
        $result = $requete->fetch();
        $film = new Film(
            intval($result['id_movie']),
            $result['title'],
            intval($result['year']),
            $result['genres'],
            $result['plot'],
            $result['directors'],
            $result['cast']
        );
        return $film;
    }
    public function selectFilmsR($nbFilm)
    {
        $pdo = new ConnectDB;
        $rq = "SELECT * FROM movies_full
        ORDER BY RAND()
        LIMIT $nbFilm";
        $requete = $pdo->connect()->prepare($rq);
        $requete->execute();
        return $requete->fetchall();
    }
    public function selectGenres()
    {
        $pdo = new ConnectDB;
        $rq = "SELECT
            substring_index(genres, ',', 1) 
            AS genre
            FROM movies_full GROUP BY genre
            ";
        $requete = $pdo->connect()->prepare($rq);
        $requete->execute();
        return $requete->fetchall();
    }
}
