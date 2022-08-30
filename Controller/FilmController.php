<?php
if( $_SERVER['PHP_SELF'] === '/POO/netflix/index.php'){
    $pref = "./";
} else {$pref = '../';}
require_once($pref."Controller/RouteController.php");
$routeController = new RouteController($_SERVER);
require_once($routeController->getModele("Film"));
require_once($routeController->getRepository("FilmRepository"));
class FilmController
{
    public static function selectRandomFilms($nbFilm){
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets()."img/posters/";
        $ext = ".jpg";
        $filmRepository = new FilmRepository;
        $films = $filmRepository->selectFilmsR($nbFilm);
        foreach ($films as $key => $value) {
            if(file_exists($urlPoster.$value['id_movie'].$ext)){
                $films[$key]['urlFilm'] = $urlPoster.$value['id_movie'].$ext;
            } else {
                $films[$key]['urlFilm'] = $urlPoster."default.jpg";
            }
        }
        return $films;
    } 
    public static function menuGenre(){
        $filmRepository = new FilmRepository;
        return $filmRepository->selectGenres();
    }
    public static function getFilmsByGenre($genre){
        $filmRepository = new FilmRepository;
        $routeController = new RouteController($_SERVER);
        $urlPoster = $routeController->getAssets()."img/posters/";
        $ext = ".jpg";
        $index = 0;
        $nbFilms = 20;
        $films = $filmRepository->selectFilmsByGenre($genre,$index,$nbFilms);
        foreach ($films as $key => $value) {
            if(file_exists($urlPoster.$value['id_movie'].$ext)){
                $films[$key]['urlFilm'] = $urlPoster.$value['id_movie'].$ext;
            } else {
                $films[$key]['urlFilm'] = $urlPoster."default.jpg";
            }
        }
        return $films;
    }   
}
