<?php

require_once("../../tp3-helpers.php");

function recherche_film($value)
{
  $langue = ['language'=>'fr'];
  $film = tmdbget("movie/".$value,$langue);
  $table_film = json_decode($film,true);
  if (isset ($table_film['id'])){
    $title = $table_film['title'];
    $original_title = $table_film['original_title'];
    $overview = $table_film['overview'];
    $tagline = $table_film['tagline'];

    printf("<h1> $title </h2>");
    printf("<p> Titre original : $original_title </p>");
    printf("<p> Description : $overview </p>");
    if (!empty($tagline)) {
      printf("<p> Mots cles/ Phrase d'accroche : $tagline </p>");
    }
    $homepage = str_replace(" ","-",$title);
    printf("<a href=\"https://www.themoviedb.org/movie/".$value.$homepage."\"> page du film </a> ");
  } else {
    printf("<p> Numero invalide </p>");
  }

}

 ?>
