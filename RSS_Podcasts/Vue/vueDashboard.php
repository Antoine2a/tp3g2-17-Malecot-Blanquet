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
      require_once("../Controleur/dashboard.php");

      $url_podcasts = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
      $rss = getRSS($url_podcasts);
      $RSS_list = array($rss); //displayPodcasts peut affiche plusieurs podcasts, il prend en paramètre un tableau de tous les podcasts rss possibles.
      displayPodcasts($RSS_list);
      ?>
    </table>
  </div>


</body>
</html>
