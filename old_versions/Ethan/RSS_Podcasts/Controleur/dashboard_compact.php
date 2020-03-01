<?php

require_once('../vendor/dg/rss-php/src/Feed.php');





// var_dump($rss);
//
// foreach ($rss->item as $item) {
// 	echo 'Title: ', $item->title;
// 	echo 'Link: ', $item->link;
// 	echo 'Timestamp: ', $item->timestamp;
// 	echo 'Description ', $item->description;
// 	echo 'HTML encoded content: ', $item->{'content:encoded'};
// }

// $atom = Feed::loadAtom($url);



/**
 * Initialisation et Récupération du fichier au format RSS
 * @param string $url -> the website link of the rss
 * @return Feed $rss -> content of the rss
**/
function getRSS($url) {
	$rss = Feed::loadRss($url);
	Feed::$cacheDir = __DIR__ . '/tmp';
	Feed::$cacheExpire = '5 hours';
	return $rss;
}

/**
 * Affichage des podcasts
 * @param Feed $rss -> content of the rss
**/
function displayPodcasts($rss){

	//Header Line
	printf("<tr class=\"header blue\"><th>Semaine</th><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th></tr>");

	//Content - Each line correspond to a podcast
  //$rss_array = array_reverse(toArray($rss["xml"]));
	$num_glob = "Semaine numéro : "."00";
  $date_glob = "0";
	foreach ($rss->item as $item) {

		// $date = htmlspecialchars($item->pubDate);
		$time = date('H:i', (int) $item->timestamp);
		$title = htmlspecialchars($item->title);
		// $mp3 = "temp";
    $date = date('j.n.Y', (int) $item->timestamp);
		$mp3 = $item->enclosure->attributes();
    $jour = date('w', (int) $item->timestamp);

	  $num_sem = "Semaine numéro : ".date('W', (int) $item->timestamp);
    if ($num_glob=="Semaine numéro : "."00"){
      printf("<tr>");
      printf("<td>".$num_sem."</td>");
      printf("<td>");
      printf("Date : ".$date."<br><br>");
      $num_glob = $num_sem;
      $date_glob = $date;
    }
    if ($num_glob!=$num_sem){
      printf("</tr>");
      printf("<tr>");
      printf("<td>".$num_sem."</td>");      
      $num_glob = $num_sem;
    }
    if ($date_glob!=$date){
      printf("</td>");
      printf("<td>");
      printf("Date : ".$date."<br><br>");
      $date_glob =$date;
    }
    printf("Heure : ".$time."<br>"."Titre : ".$title."<br>"."<audio controls src=".$mp3."></audio>"."<br><br><br>");
	}

	// //Header Line
	// printf("<div class=\"row header blue\"><div class=\"cell\">Date</div><div class=\"cell\">Titre</th><th>Player MP3</div><div class=\"cell\">Durée</div><div class=\"cell\">Media</div></div>");
	//
	// //Content - Each line correspond to a podcast
	// foreach ($rss->item as $item) {
	// 	printf("<div class=\"row\">");
	// 	printf("<div class=\"cell\">".$item->date."</div class=\"cell\">");
	// 	printf("<div class=\"cell\">".$item->title."</div class=\"cell\">");
	// 	printf("<div class=\"cell\">PLAYER MP3</div class=\"cell\">");
	// 	printf("<div class=\"cell\">Duree</div class=\"cell\">");
	// 	// printf("<td>".$item->itunes:summary."</td>");
	// 	printf("<div class=\"cell\"><a href=\"$item->link\">".$item->title.".mp3</a></div class=\"cell\">");
	// 	printf("</div>");
	// }

}

?>
