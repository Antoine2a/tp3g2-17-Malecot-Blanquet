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
			$num_glob = $num_sem;
	 }
		printf("<tr>");
		printf("<td>".$date."</td>");
		printf("<td>".$title."</td>");
		//printf("<td>".$mp3."</td>");
		printf("<td><audio controls='controls' preload='none' src=".$mp3."></audio></td>");
		printf("<td>".$duration."</td>");
		printf("<td><a href=\"$mp3\" download=\"Podcast\">Download</a></td>"); // dst-ce un lien de download ?
		printf("</tr>");
	}
}

	function displayPodcasts_hebdo($rss){

		//Header Line
		printf("<tr class=\"header blue\"><th>Semaine</th><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th></tr>");

		//Content - Each line correspond to a podcast
	  //$rss_array = array_reverse(toArray($rss["xml"]));
		$num_glob = "Semaine numéro : "."00";
	  $date_glob = "0";
		$tab_rss = array();

		foreach ($rss->item as $item) {										//inversion du flux rss pour obtenir les podcasts dans l'ordre de la semaine de lundi à vendredi
			array_unshift($tab_rss, $item);
		}
		array_shift($tab_rss);  													//élimination de la courte vidéo présentant le site de radiofrance
		foreach ($tab_rss as $item) {
			// $date = htmlspecialchars($item->pubDate);
			$time = date('H:i', (int) $item->timestamp);
			$title = htmlspecialchars($item->title);
			// $mp3 = "temp";
	    $date = date('j.n.Y', (int) $item->timestamp);
			$mp3 = $item->enclosure->attributes();
	    $jour = date('w', (int) $item->timestamp);

		  $num_sem = "Semaine numéro : ".date('W', (int) $item->timestamp);
	   	if ($num_glob=="Semaine numéro : "."00"){					//initialisation lors de la première boulce
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

	function displayPodcasts_multi($rss1,$rss2,$rss3) {
		//Header Line
		printf("<tr class=\"header blue\"><th>Date</th><th>Titre</th><th>Player MP3</th><th>Durée</th><th>Media</th></tr>");
		$max = max(array (count($rss1->item), count($rss2->item), count($rss3->item)));

	}

?>
