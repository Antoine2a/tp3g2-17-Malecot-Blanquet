<?php

require_once('../vendor/dg/rss-php/src/Feed.php');

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
	foreach ($rss->item as $item) {

		// $date = htmlspecialchars($item->pubDate);
		$date = date('j.n.Y H:i', (int) $item->timestamp);
		$title = htmlspecialchars($item->title);
		$enclosure = $item->enclosure->attributes();
		$mp3 = $enclosure['url']; //récupération de l'attribut "url"

	 // BLA-19/02/2020 : Tutoriel : Comment récupérer les données XML de type "<itunes:author>"
	 // https://www.sitepoint.com/parsing-xml-with-simplexml/
	 $namespacces = $item->getNamespaces(true);
	 $itunes = $item[0]->children($namespacces["itunes"]);
	 $duration = $itunes->duration;

		printf("<tr>");
		printf("<td>".$date."</td>");
		printf("<td>".$title."</td>");
		printf("<td><audio controls src=".$mp3."></audio></td>"); //BLA-19/02/2020 : Pb trop de lecteurs affichées. + check consigne : norme vue en cours ?
		printf("<td>".$duration."</td>");
		printf("<td><a href=\"$mp3\">Download</a></td>");
		printf("</tr>");
	}
}

?>
