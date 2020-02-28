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
	printf("<tr class=\"header blue\"><th>Vendredi</th><th>Jeudi</th><th>Mercredi</th><th>Mardi</th><th>Lundi</th></tr>");

	//Content - Each line correspond to a podcast

	$num_glob = "Semaine numéro : "."00";
  $date_glob = "0";
  printf("<tr>");
  printf("<td>");
	foreach ($rss->item as $item) {

		// $date = htmlspecialchars($item->pubDate);
		$date = date('j.n.Y H:i', (int) $item->timestamp);
		$title = htmlspecialchars($item->title);
		// $mp3 = "temp";
    $date_red = date('j.n.Y', (int) $item->timestamp);
		$mp3 = $item->enclosure->attributes();

	  $num_sem = "Semaine numéro : ".date('W', (int) $item->timestamp);
    if ($num_glob!=$num_sem){
      printf("</tr>");
      printf("<tr>");
      $num_glob = $num_sem;
    }
    if ($date_glob!=$date_red){
      printf("</td>");
      printf("<td>");
      $date_glob =$date_red;
    }
    printf("Date : ".$date."<br>"."Titre : ".$title."<br>"."<audio controls src=".$mp3."></audio>"."<br><br><br>");
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
