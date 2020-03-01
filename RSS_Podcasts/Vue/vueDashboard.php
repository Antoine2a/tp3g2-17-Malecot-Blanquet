<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Tableau des podcasts</title>
  <link rel="stylesheet" href="VueDashboard.css">
</head>
<body>
  <h1>Tableau des podcasts</h1>

  <form action="vueDashboard.php" method="post">

    <label for="podcast_view">Choix de l'affichage </label>

    <select name="podcast_view" id="podcast_view">
      <option value="loadPodcasts" selected>Afficher Podcasts - Vue Classique</option>
      <option value="loadPodcasts_multi">Afficher Podcasts (MultiPodcasts) - Vue Classique</option>
      <option value="loadPodcasts_twitter">Afficher Podcasts (Liens Twitter)- Vue Classique</option>
      <option value="loadPodcasts_hebdo">Afficher Podcasts - Vue Hebdomaire</option>
    </select>
    <input type="submit" name="Valider Affichage"/><br><br>
  </form>
  <hr>

  <div class="wrapper">
    <table>
      <?php
      require_once("../Controleur/dashboard.php");

      if (isset($_POST["podcast_view"])) {
        $view = $_POST['podcast_view'];
        switch ($view) {
          case 'loadPodcasts':
            $url_podcasts = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
            $rss = getRSS($url_podcasts);
            $RSS_list = array($rss); //displayPodcasts peut affiche plusieurs podcasts, il prend en paramètre un tableau de tous les podcasts rss possibles.
            displayPodcasts($RSS_list,false);
            break;
          case 'loadPodcasts_multi':
            $url1 = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
            $url2 = "http://radiofrance-podcast.net/podcast09/rss_14310.xml";
            $url3 = "http://radiofrance-podcast.net/podcast09/rss_14311.xml";
            $rss1 = getRSS($url1);
            $rss2 = getRSS($url2);
            $rss3 = getRSS($url3);
            $RSS_list = array($rss1,$rss2,$rss3); //fusion des podcasts RSS
            displayPodcasts($RSS_list,false);
            break;
          case 'loadPodcasts_twitter':
            $url_podcasts = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
            $rss = getRSS($url_podcasts);
            $RSS_list = array($rss); //displayPodcasts peut affiche plusieurs podcasts, il prend en paramètre un tableau de tous les podcasts rss possibles.
            displayPodcasts($RSS_list,true);
            break;
          case 'loadPodcasts_hebdo':
            $url = "http://radiofrance-podcast.net/podcast09/rss_14312.xml";
            $rss = getRSS($url);
            displayPodcastsHebdo($rss);
            break;
        }
      }

      ?>
    </table>
  </div>


</body>
</html>
