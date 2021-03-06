<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Tableau des podcasts</title>
  <link rel="stylesheet" href="VueDashboard.css">
</head>
<body>
  <h1>Tableau des podcasts</h1>

<div class="wrapper">
  <table>
    <?php
    require_once("../Controleur/dashboard.php"); //bien être situé au niveau du répertoire RSS_Podcasts/Vue
    // require_once("/home/blanquan/popos5/Tronc_Info/PW/tp3g2-17-Malecot-Blanquet/Antoine/RSS_Podcasts/Controleur/dashboard.php"); (lien directe)
    require_once("../../../simplehtmldom_1_9_1/simple_html_dom.php");
    // require_once("../../../getID3-master/demos/demo.browse.php");

    $url1 = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
    $url2 = "http://radiofrance-podcast.net/podcast09/rss_14310.xml";
    $url3 = "http://radiofrance-podcast.net/podcast09/rss_14311.xml";
    $rss1 = getRSS($url1);
    $rss2 = getRSS($url2);
    $rss3 = getRSS($url3);
    // displayPodcasts($rss1);
    // displayPodcasts($rss2);
    displayPodcastsMulti($rss1,$rss2,$rss3);

    ?>

  </table>
</div>


</body>
</html>
