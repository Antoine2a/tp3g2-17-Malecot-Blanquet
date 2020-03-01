<?php

require_once("../Controleur/dashboard.php"); //bien être situé au niveau du répertoire RSS_Podcasts/Vue
// require_once("/home/blanquan/popos5/Tronc_Info/PW/tp3g2-17-Malecot-Blanquet/Antoine/RSS_Podcasts/Controleur/dashboard.php"); (lien directe)
require_once("../../../simplehtmldom_1_9_1/simple_html_dom.php");
require_once("../../../getID3-master/demos/demo.browse.php");


$url_podcasts = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
$rss = getRSS($url_podcasts);
displayPodcasts($rss);


 ?>
