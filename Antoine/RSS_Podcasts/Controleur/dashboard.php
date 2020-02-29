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
	printf("<tr class=\"header blue\"><th>Date</th><th>Titre</th><th>Player MP3</th><th>Durée</th><th>Media</th><th>Sources Twitter (via DOM)</th></tr>"); echo "\n\t";

	$num_current_week = "Semaine numéro : "."00";//Initialisation numéro de la semaine
	//Content - Each line correspond to a podcast
	foreach ($rss->item as $item) {

		$date = date('j.n.Y H:i', (int) $item->timestamp);
		$title = htmlspecialchars($item->title);
		$enclosure = $item->enclosure->attributes();
		$mp3 = $enclosure['url']; //récupération de l'attribut "url"
		// $link_twitter = getTwitter($item->link);
		$link_twitter = "temporaire";

		// BLA-19/02/2020 : Tutoriel : Comment récupérer les données XML de type "<itunes:author>"
		// https://www.sitepoint.com/parsing-xml-with-simplexml/
		$namespacces = $item->getNamespaces(true);
		$itunes = $item[0]->children($namespacces["itunes"]);
		$duration = $itunes->duration;

		//Intercalage hebdomadaire
		$num_week_podcast = "Semaine numéro : ".date('W', (int) $item->timestamp);
		if ($num_current_week!=$num_week_podcast){
			printf("<tr>");
			printf("<td class=\"week\" colspan=\"6\">".$num_week_podcast."</td>");
			printf("</tr>"); echo "\n\t";
			$num_current_week = $num_week_podcast;
		}
		printf("<tr>");	echo "\n\t\t";
		printf("<td>".$date."</td>");	echo "\n\t\t";
		printf("<td>".$title."</td>");	echo "\n\t\t";
		printf("<td><audio controls preload='none' src=".$mp3."></audio></td>");	echo "\n\t\t";
		printf("<td>".$duration."</td>");	echo "\n\t\t";
		printf("<td><a href=\"$mp3\" download=\"Koala\">Download</a></td>");	echo "\n\t\t";
		if ( !empty($link_twitter)){
			echo("<td><a href=\"".$link_twitter."\">Lien Twitter</a></td>");	echo "\n\t";
		} else {
			printf("<td class=\"error\">Inexistant</td>");	echo "\n\t";
		}
		printf("</tr>");	echo "\n\t";
	}
}

/**
* Récupère le DOM d'une page Web
* @param string $url -> url de l'article scientifique en question
* @return string $link -> lien twitter
**/
function getTwitter($url){
		$html = new simple_html_dom();
		$html->load_file($url);
		//Parcours de tous les paragraphes du site web pour retrouver celui mentionnant le Thread Twitter
		foreach ($html->find('p') as $paragraph) {

			if (strpos($paragraph, "[Thread]") == true) {
				$link = htmlspecialchars($paragraph->find('a',0)->getAttribute('href'));
				return $link;
			}
		}
}

/**
* Affichage les podcasts hebdomadairement
* @param Feed $rss -> content of the rss
**/
function displayPodcastsHebdo($rss){

	//Header Line
	printf("<tr class=\"header blue\"><th>Semaine</th><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th></tr>");

	//Content - Each line correspond to a podcast
	$num_glob = "Semaine numéro : "."00";
	$date_glob = "0";
	$tab_rss = array();

	foreach ($rss->item as $item) {										//inversion du flux rss pour obtenir les podcasts dans l'ordre de la semaine de lundi à vendredi
		array_unshift($tab_rss, $item);
	}
	array_shift($tab_rss);  													//élimination de la courte vidéo présentant le site de radiofrance
	foreach ($tab_rss as $item) {
		$time = date('H:i', (int) $item->timestamp);
		$title = htmlspecialchars($item->title);
		$date = date('j.n.Y', (int) $item->timestamp);
		$mp3 = $item->enclosure->attributes();
		$jour = date('w', (int) $item->timestamp);

		$num_sem = "Semaine numéro : ".date('W', (int) $item->timestamp);
		if ($num_glob=="Semaine numéro : "."00"){					//initialisation lors de la première boucle
			printf("<tr>");
			printf("<td>".$num_sem."</td>");
			if ($jour ==  5) {																//déplacement de cases pour bien placé le premier élément reçu en fonction du jour de la semaine
				printf("<td></td><td></td><td></td><td></td>");
			} else if ($jour == 4) {
				printf("<td></td><td></td><td></td>");
			} else if ($jour == 3) {
				printf("<td></td><td></td>");
			} else if ($jour == 2) {
				printf("<td></td>");
			}
			printf("<td>");
			printf("Date : ".$date."<br><br>");
			$num_glob = $num_sem;
			$date_glob = $date;
		}

		if ($num_glob!=$num_sem){															//changement de ligne car semaine différente
			printf("</tr>");
			printf("<tr>");
			printf("<td>".$num_sem."</td>");
			$num_glob = $num_sem;
		}
		if ($date_glob!=$date){																//changement de case car jour différent
			printf("</td>");
			printf("<td>");
			printf("Date : ".$date."<br><br>");
			$date_glob =$date;
		}
		printf("Heure : ".$time."<br>"."Titre : ".$title."<br>"."<audio controls='controls' preload='none' src=".$mp3."></audio>"."<br><br><br>");
	}
}

?>
