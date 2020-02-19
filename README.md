# tp3g2-17-Malecot-Blanquet
INFO3-PW - TP3 - TMDB, Podcasts


# Partie 1 - TMDB
### Mise en forme

Q1 ) Exploration. Quel est le format de réponse ? De quel film s’agit-il ? Essayez avec le paramètre supplémentaire language=fr

> On obtient une réponse de format JSON : un format que l'on peut utiliser pour sérialiser des données structurées (tableaux, objets..). C'est cohérent ici car on souhaite structurer ici les données de nombreux films.
le champ "original_title" nous donne le titre du film : "Fight Club"
le paramètre language=fr nous permet d'obtenir le JSON du film avec les informations en français. Il doit exister différents fichiers avec la même structure JSON pour chacune des langues proposer par le site.

Q2) Exploration CLI. Testez également le service avec curl en ligne de commande, puis avec un programme php minimal utilisant tp3-helper.php.

>
