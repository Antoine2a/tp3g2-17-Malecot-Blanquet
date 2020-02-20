<?php

require_once("../../tp3-helpers.php");

/**
* renvoie un film
* @param int $id du film
* @param string $lang : fr/en/ru ...
* @return Array $film_JSON : parsing du JSON d'un film dans une array
**/
function getFilm($id,$lang) {
  $url = "movie/".$id;
  $params = ['language' => $lang];
  $film_strJSON = tmdbget($url,$params);
  $film_JSON = json_decode($film_strJSON, true); //Nota: false -> renvoie un Objet / true -> renvoie tableau associatif
  return $film_JSON;
}

/**
* Affiche sur le Web un film
* @param Array $film : contient les datas d'un film.
**/
function afficherFilm($film) {

  if (!isset($film["id"])) { //si id de film non défini
    printf("<p class=\"error\">Identifiant Invalide.</p>");
  } else {

    //récupération des données
    $title = $film["title"];
    $original_title = $film["original_title"];
    $tagline = $film["tagline"];
    $desc = $film["overview"];
    $linkTMDB = $film["homepage"];
    $title_format_link = str_replace("-"," ",$title);
    $linkTMDB= "https://www.themoviedb.org/movie/".$film["id"]."-".$title_format_link;

    printf("<h1>Affichage Film</h1>");
    //Affichage du Titre
    afficherData($title,"Titre du Film");
    //Affichage du Titre Original
    afficherData($original_title,"Titre du Film Original");
    printf("<hr>");
    //Affichage du slogan du film
    if ( !empty($tagline)){
      afficherData($tagline,"Slogan");
    } else {
      printf("<p class=\"error\"> Ce film ne possède pas de slogan.</p>");
    }
    printf("<hr>");
    //Affichage de la description du film
    afficherData($desc,"Description du film");

    printf("<p><strong>Lien du film sur TMDB : ");
    printf("<a href=\"$linkTMDB\">".$title."</a>");
    printf("</strong></p>");
  }
}

/**
* Affiche une donnée sur la page Web
* @param string $data
* @param string $label : intitulé du texte à afficher (correspondant à data).
**/
function afficherData($data,$label) {
  printf("<div class=\"quote\">");
  printf("<blockquote>");
  printf("<p>".$data."</p>");
  printf("<cite>".$label."</cite>");
  printf("</blockquote>");
  printf("</div>");
}
?>
