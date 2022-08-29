<?php


require_once("../Modele/Film.php");
class FilmController
{
    public static function selectRandomFilms($nbFilm){
        $urlPoster = "../assets/img/posters/";
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
}
