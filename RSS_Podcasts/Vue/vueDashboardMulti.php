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

      $url1 = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
      $url2 = "http://radiofrance-podcast.net/podcast09/rss_14310.xml";
      $url3 = "http://radiofrance-podcast.net/podcast09/rss_14311.xml";
      $rss1 = getRSS($url1);
      $rss2 = getRSS($url2);
      $rss3 = getRSS($url3);
      $RSS_list = array($rss1,$rss2,$rss3); //fusion des podcasts RSS
      displayPodcasts($RSS_list);
      ?>
    </table>
  </div>


</body>
</html>
