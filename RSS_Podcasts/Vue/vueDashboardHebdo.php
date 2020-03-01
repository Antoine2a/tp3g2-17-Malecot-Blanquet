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
      require_once("../Controleur/dashboard.php");

      $url = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
      $rss = getRSS($url);
      displayPodcastsHebdo($rss);
      ?>
    </table>
  </div>


</body>
</html>
