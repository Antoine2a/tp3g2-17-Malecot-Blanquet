<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <title>WikiFilm</title>
  <link rel="stylesheet" href="film.css">
</head>
<body>
  <header>
    <form action="film.php" method="post">
      <label for="id_film">Identifiant</label>
      <input id="id_film" type="number" name="id_film" value="<?php if (isset($_POST["id_film"])){ printf($_POST["id_film"]);} ?>" placeholder="L'identifiant du film..."required />
      <input type="submit" value="Afficher Film" /><br>
    </form>
  </header>

  <hr>
  <div class="content">
    <div class="film_body">
      <?php
      require_once("utils.php");

      if (isset($_POST["id_film"])){
        $id = $_POST["id_film"];
        $film = getFilm($id,"fr");
        afficherFilm($film);
      } else {
        print_r("<p class=\"error\">Aucun film n'a été renseignée pour le moment.</p>");
      }
      ?>
    </div>
  </div>

  <footer>
    <p>
      <a href="https://validator.w3.org/check?uri=referer"><img
        src="https://www.w3.org/Icons/valid-html401-blue"
        alt="Valid HTML 4.1!" height="31" width="88" /></a>
      </p>
      <p>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
          <img style="border:0;width:88px;height:31px"
          src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
          alt="CSS Valide !" />
        </a>
      </p>
    </footer>
  </body>
  </html>
