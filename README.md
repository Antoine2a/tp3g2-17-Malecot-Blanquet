# tp3g2-17-Malecot-Blanquet

Malecot Ethan - Blanquet Antoine

# TP3 - TMDB & Podcasts

Quick Start
===

**Q:** Comment tester notre projet ?

**A:** Clonez-le et executez les fichiers php suivants :

  * TMDB : `/TMDB/film.php`

  + RSS_Podcasts:
    * Tableaux des Podcasts : `/RSS_Podcasts/Vue/vueDashboard.php` (Liens Twitter en appuyant sur `Charger Ressources Twitter`)

    * Tableaux des Podcasts - Vue Hebdomadaire : `/RSS_Podcasts/Vue/vueDashboardHebdo.php`
    * Tableaux des Podcasts - Fusion de plusieurs Podcasts : `/RSS_Podcasts/Vue/vueDashboardMulti.php`

:warning: Le répértoire `/old_versions` contient nos versions de dev du TP. Afin de progresser en PHP, nous avons décider de réaliser la majeur partie des questions de notre coté pour ensuite sélectionner les implémentations les plus cohérente dans les répertoires `/TMDB` et `/RSS_Podcasts`

---

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


###### 2. Intercalaire Hebdomadaire

Pour cette question, nous avons récupéré dans une variable le numéro de la semaine grace à fonction "date" de PHP qui avec l'argument 'W' rend le numéro de semaine. Puis nous avons ajouté une condition pour afficher sur une ligne la case de numéro de semaine seulement lorsque l'on change de semaine par rapport au dernier enregistrement audio traité (la commande colspan nous a permis de faire une seule case sur toute la ligne).

###### 3. Tableau Hebdomadaire

Afin d'obtenir un affichage Hebdomadaire nous avons commencé par inverser l'ordre d'arriver des élémentsdu flux rss, qui arrivait du plus récent au plus ancient, afin d'avoir la enregistrement audio dans l'ordre des jours de la semaine et non dans l'ordre inverse. Ensuite nous avons aussi ajouté une initialisation dans la boucle foreach pour placer correctement le premier enregistrement au jour correspondant et ainsi que tous les enregistrement après celui-ci soient directement bien placé sans avoir besoin de faire de calculs. Enfin, nous avons une condition sur la jour et une condition sur la semaine qui définissent si l'on passe à la case suivante et si l'on passe à la ligne suivante respectivement.

###### 4.


###### 5. Attribut du MP3

Le bitrate standart du podcast est 128 kbps et il est en stereo (une impression d'écran correspondant au commandant effectuée dans la console est jointe). Ces informations sont données en utilisant mp3info avec -x.

###### 6. Réencodage

En utilisant lame les deux commandes pour faire le réencodage demandé sont :

-> -b 32 pour obtenir les 32 kbps demandés
-> -m mode=m pour obtenir le mode mono au lieu de stereo

Une impression d'ecran est jointe ainsi que les fichiers mp3 avant et après réencodage (14312-28.02.2020-ITEMA_22294516-1.mp3 (avant) et 14312-28.02.2020-ITEMA_22294516-1.mp3.mp3 (après)).

###### 7.
