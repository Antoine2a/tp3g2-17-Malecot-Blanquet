<?php

//TESTS ID3 fichiers MP3 - Question en cours ...


require_once("../Controleur/dashboard.php");

$url_podcasts = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
$rss = getRSS($url_podcasts);
displayPodcasts($rss);


 ?>
