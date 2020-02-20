# tp3g2-17-Malecot-Blanquet

Malecot Ethan - Blanquet Antoine
# TP3 - TMDB & Podcasts


## Partie 1 - Utilisation de The Movie Database
### 1. Mise en jambes

###### Q1 - Exploration. Quel est le format de réponse ? De quel film s’agit-il ? Essayez avec le paramètre supplémentaire language=fr

On obtient une réponse au format **JSON** : un format que l'on peut utiliser pour sérialiser des **données structurées** (tableaux, objets..). C'est cohérent ici car on souhaite structurer ici les données de nombreux films.

Le champ **"original_title"** nous donne le titre du film : "Fight Club".

Le paramètre **language=fr** nous permet d'obtenir le JSON du film avec les informations en français. Il doit exister différents fichiers avec la même structure JSON pour chacune des langues proposer par le site.

###### Q2 - Exploration CLI. Testez également le service avec curl en ligne de commande, puis avec un programme php minimal utilisant tp3-helper.php.

>Dans le fichier ***utils.php***

On récupère le  fichier JSON d'un film et on le décode.

>function **getFilm**($id,$lang);

###### Q3 - Page de détail (web). Pour un film fourni par son identifiant (un entier), vous afficherez une page web donnant les éléments suivants : son titre, son titre original, sa tagline (si elle existe), sa description, et un lien vers la page publique TMDB.

>Dans le fichier ***film.php*** (Vue)

Affiche le contenu à l'utilisateur (film) et transmet les commandes de l'utilisateur au **Controleur** (id).

>Dans le fichier ***utils.php*** (Controleur)

Gestion de la logique du code : c'est ici qu'on créer la data pour la **Vue**.

>function **getFilm**($id,$lang) -> récupère un film en fonction de l'id fourni.

>function **afficherFilm**($film) -> affiche les informations du Film sur la page web (*film.php*).

>function **afficherData**($data,$label) -> affiche une donnée en particulier dans une div


### 2. Les choses sérieuses

Non implémenté : Choix du sujet d'approfondissement sur les **RSS_Podcasts**.

---

## Partie 2 - Analyse d'un flux RSS de podcast
### 1. Mise en jambes

###### 1. Tableau des podcasts
