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
