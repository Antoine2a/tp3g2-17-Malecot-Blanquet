<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Tableau des podcasts</title>
  <link rel="stylesheet" href="VueDashboard.css">
  <link rel="stylesheet" href="utils.css">
</head>
<body>
  <h1>Tableau des podcasts : Vue Hebdomadaire</h1>

<div class="wrapper">
  <table>
    <?php
    require_once("../Controleur/dashboard.php"); //bien être situé au niveau du répertoire RSS_Podcasts/Vue
    // require_once("/home/blanquan/popos5/Tronc_Info/PW/tp3g2-17-Malecot-Blanquet/Antoine/RSS_Podcasts/Controleur/dashboard.php"); (lien directe)
    require_once("../../../simple_html_dom.php");

    $url = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
    $rss = getRSS($url);
    displayPodcastsHebdo($rss);
    ?>

  </table>
</div>


</body>
</html>
