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
	printf("<tr class=\"header blue\"><th>Date</th><th>Titre</th><th>Player MP3</th><th>Durée</th><th>Media</th></tr>");

	//Content - Each line correspond to a podcast

	$num_glob = "Semaine numéro : "."00";
	foreach ($rss->item as $item) {

		// $date = htmlspecialchars($item->pubDate);
		$date = date('j.n.Y H:i', (int) $item->timestamp);
		$title = htmlspecialchars($item->title);
		// $mp3 = "temp";
		$mp3 = $item->enclosure->attributes();
		// <audio
		// controls
		// src="/media/examples/t-rex-roar.mp3">
		// 		Your browser does not support the
		// 		<code>audio</code> element.
	 // </audio>
	 // $duration = $item->itunes->getNamespaces(true)["author"];

	 // BLA-19/02/2020 : Tutoriel : Comment récupérer les données XML de type "<itunes:author>"
	 // https://www.sitepoint.com/parsing-xml-with-simplexml/
	 $namespacces = $item->getNamespaces(true);
	 $itunes = $item[0]->children($namespacces["itunes"]);
	 $duration = $itunes->duration;
	 $num_sem = "Semaine numéro : ".date('W', (int) $item->timestamp);
	 if ($num_glob!=$num_sem){
			printf("<tr>");
	 		printf("<td colspan=\"5\">".$num_sem."</td>");
	 		printf("</tr>");
	 }
	 $num_glob = $num_sem;
		printf("<tr>");
		printf("<td>".$date."</td>");
		printf("<td>".$title."</td>");
		//printf("<td>".$mp3."</td>");
		printf("<td><audio controls src=".$mp3."></audio></td>");
		printf("<td>".$duration."</td>");
		printf("<td><a href=\"$mp3\">Download</a></td>"); // dst-ce un lien de download ?
		printf("</tr>");
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
