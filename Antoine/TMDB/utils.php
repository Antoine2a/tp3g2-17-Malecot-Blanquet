<?php

require_once("../../tp3-helpers.php");

/**
* TMDB query function
* @param string $urlcomponent (after the prefix)
* @param array (associative) GET parameters (ex. ['language' => 'fr'])
* @return string $content
**/

function getFilm($id,$lang) {

  $url = "movie/".$id;
  $params = ['language' => $lang];

  $film_strJSON = tmdbget($url,$params);
  $film_JSON = json_decode($film_strJSON, true); //Nota: false -> renvoie un Objet / true -> renvoie tableau associatif
  return $film_JSON;
}

function afficherFilm($film) {


  if (!isset($film["id"])) {
    printf("<p>ID Invalide.</p>");
  } else {
    $title = $film["title"];
    $original_title = $film["original_title"];
    $tagline = $film["tagline"]; //si elle existe
    $desc = $film["overview"];
    $linkTMDB = $film["homepage"];
    $title_format_link = str_replace("-"," ",$title);
    $linkTMDB= "https://www.themoviedb.org/movie/".$film["id"]."-".$title_format_link;
    printf("<h3> Informations sur le film d'ID : ".$film["id"]."</h3>");

    printf("<p> Titre du Film : ".$title."<p>");
    printf("<p> Titre du Film Original : ".$original_title."<p>");
    if ( !empty($tagline)){
      printf("<p> Slogan : ".$tagline."<p>");
    } else {
      printf("<p> Tagline non existante<p>");
    }
    printf("<p> Description du Film :".$desc."<p>");

    printf("<p>Lien du film sur TMDB : ");
    printf("<a href=\"$linkTMDB\">".$title."</a>");
    printf("</p>");
  }
}

?>
