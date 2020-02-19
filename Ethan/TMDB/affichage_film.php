<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <title> Recherche d'un film </title>
  </head>
  <body>
    <form method="get" action="affichage_film.php">
    <label for="num_film">Numero du film</label> <input type="number" id="num_film" name="num_film"/> <br />
    <input type="submit"/>
    </form>

    <?php
    require_once("utils.php");


    if (isset($_GET['num_film'])) {
      recherche_film($_GET['num_film']);
    } else {
      echo "Veuillez renseigner un numéro de film";
    }

    ?>

  </body>
</html>
