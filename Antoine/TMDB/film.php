<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Information Film</title>
    <link rel="stylesheet" href="film.css">
  </head>
  <body>

    <form action="film.php" method="post">
      <label for="id_film">Veuillez indiquez le numéro du film</label><input type="number" name="id_film" value="id_film" placeholder=550 required> <br>
      <input type="submit" /><br><br>
    </form>
    <hr>

    <?php
      require_once("utils.php");

      if (isset($_POST["id_film"])){
        $id = $_POST["id_film"];
        $film = getFilm($id,"fr");
        afficherFilm($film);
      } else {
        print_r("Aucun film n'a été renseignée pour le moment.");
      }
     ?>

  </body>
</html>
