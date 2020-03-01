<?php

require_once('../vendor/dg/rss-php/src/Feed.php');
require_once("../../simplehtmldom_1_9_1/simple_html_dom.php");
// require_once("../../getID3-master/demos/demo.browse.php");

/**
* Initialisation et Récupération du fichier au format RSS
* @param string $url -> the website link of the rss
* @return Feed $rss -> content of the rss
**/
function getRSS($url) {
	$rss = Feed::loadRss($url);

	if (empty(__DIR__ . '/tmp')) { //Gestion d'un cache des données - Nota : ne pas recréer un cache si il existe toujours
		Feed::$cacheDir = __DIR__ . '/tmp';
		Feed::$cacheExpire = '5 hours';
	}
	return $rss;
}



function testMp3($mp3){

	//
	// $tags = id3_get_tag($mp3);
	// echo "ALLO";
	// var_dump($tags);

}

//Fonction de comparaison pour des dates
function date_sort_modif($d1, $d2) {
	$date1 = date('j.n.Y H:i', (int) $d1->timestamp); //On récupère la date de publication de l'item
	$date2 = date('j.n.Y H:i', (int) $d2->timestamp);
  return strtotime($date2) - strtotime($date1);
}

/**
* Affichage des émissions d'un ou plusieurs podcasts
* @param array $RSS_list -> liste d'objets @param Feed -> contenu d'un podcast (rss)
* @param boolean $loadLinksTwitter -> vrai : on récupère au travers d'un DOM, les liens des Threads Twitter (quelques secondes de chargements);
* 																		faux : chargement des podcasts sans liens Twitter (aucuns lag)
**/
function displayPodcasts($RSS_list, $loadLinksTwitter) {
	/*
	Idée d'implémentation : 1. Insérer TOUS les items de chacuns des podcasts dans une même array.
													2. Trier cette liste en fonction de la date de publication du podcast
													3. Afficher les podcasts, un par un avec l'item courant. (le podcast courant)
	*/
	//Header Line
	if ($loadLinksTwitter) {
		printf("<tr class=\"header blue\"><th>Date</th><th>Titre</th><th>Player MP3</th><th>Durée</th><th>Media</th><th>Sources Twitter (via DOM)</th></tr>"); echo "\n\t";
	} else {
		printf("<tr class=\"header blue\"><th>Date</th><th>Titre</th><th>Player MP3</th><th>Durée</th><th>Media</th></tr>"); echo "\n\t";
	}

  $item_list = array();
	//1. Insérer TOUS les items de chacuns des podcasts dans une même array.
	foreach ($RSS_list as $rss) {
		foreach ($rss->item as $item) {
			array_push($item_list, $item);
		}
	}
	//2. Trier cette liste en fonction de la date de publication du podcast
	usort($item_list, "date_sort_modif");

	///3. Afficher les podcasts, un par un avec l'item courant. (le podcast courant)
	$num_current_week = "Semaine numéro : "."00";//Initialisation numéro de la semaine
	//Content - Each line correspond to a podcast
	foreach ($item_list as $item) {

		$date = date('j.n.Y H:i', (int) $item->timestamp);
		$title = htmlspecialchars($item->title);
		$enclosure = $item->enclosure->attributes();
		$mp3 = $enclosure['url']; //récupération de l'attribut "url"
		if ($loadLinksTwitter) {
			$link_twitter = getTwitterLink($item->link);
		}

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
		if ($loadLinksTwitter) {
			if ( !empty($link_twitter)){
				echo("<td><a href=\"".$link_twitter."\">Lien Twitter</a></td>");	echo "\n\t";
			} else {
				printf("<td class=\"error\">Inexistant</td>");	echo "\n\t";
			}
		}
		printf("</tr>");	echo "\n\t";
	}
}

/**
* Récupère le lien twitter de la page d'un podcast en fonction de son url
* Le lien est renvoyé uniquement si un Thread Twitter est crée pour le podcast sur la page web
* @param string $url -> url de l'article scientifique en question
* @return string $link -> lien twitter
**/
function getTwitterLink($url){
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
