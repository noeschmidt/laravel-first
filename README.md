Rendu Laravel Noé

Processus d'installation:

1. On git clone le repo
   git clone https://github.com/noeschmidt/laravel-first.git

2. Sur Phpmyadmin, on crée une nouvelle table qu'on va nommer "noe_crea_dev_rendu"

3. On copie le contenu du .env.example dans un fichier .env en vérifiant que les ports, le nom de la db, l'username et le password soit correcte (Sachant que pour moi c'est DB_HOST=127.0.0.1, DB_PORT=8889, DB_DATABASE=noe_crea_dev_rendu, DB_USERNAME=root, DB_PASSWORD=root)

4. On exécute (en vérifiant qu'on est bien dans la racine du projet les commandes suivantes, dans l'ordre):

-   npm install
-   composer install
-   php artisan migrate:fresh
-   php artisan db:seed
-   composer run dev

5. On va sur http://localhost:8000 -> et on arrive sur mon site

Maintenant, je vais expliquer comment est structuré mon site et comment se déplacer dedans:
Il y a la navbar avec différents choix.
La première étape est de vérifier que tout est ok en tant que visiteur, donc on ne touche pas aux boutons Log in et Register pour l'instant

Sur la page d'accueil, il y a les 10 derniers films, les 10 derniers acteurs et en scrollant on voit les 10 derniers showtimes.

On commence par cliquer sur "Artists" dans la navbar.

On arrive sur une vue en tableau des artists, on voit qu'en tant que visiteur, on ne peut pas créer d'artiste.

On peut soit se balader avec la pagination en bas, soit cliquer sur le last name d'un artiste pour voir sa fiche. (Exemple: Coppola, Lynch...)

Quand on est sur la fiche, on peut voir des films pour lesquels il est assigné en tant que directeur et des films dans lesquels il a joué.

Les noms sont randoms et générés par Faker.

On a le choix de cliquer sur "View" pour aller directement voir le film correspondant.

Ensuite, on peut cliquer sur "Movies" dans la navbar.

Même principe que pour artistes, on a un tableau de film avec différentes infos, et on peut cliquer sur le title d'un film pour voir les détails.

Puis, on peut aller sur "Countries" dans la navbar.

Ici, j'ai simplement listés les pays qui sont générés par Faker, parfois,
