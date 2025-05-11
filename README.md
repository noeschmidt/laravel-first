# Documentation du Projet Laravel de Noé Schmidt

Ce document détaille le processus d'installation de l'application Laravel ainsi qu'un guide d'exploration de ses fonctionnalités, tant en mode visiteur qu'en mode utilisateur connecté.

## I. Processus d'Installation

Pour mettre en place et lancer l'application, veuillez suivre attentivement les étapes ci-dessous :

1.  **Clonage du Dépôt Git**
    Récupérez les fichiers du projet depuis le dépôt GitHub avec la commande suivante :

    ```bash
    git clone https://github.com/noeschmidt/laravel-first.git
    ```

2.  **Création de la Base de Données**
    Via PhpMyAdmin (ou tout autre outil de gestion de base de données MySQL/MariaDB), créez une nouvelle base de données. Nommez-la `noe_crea_dev_rendu`.

3.  **Configuration de l'Environnement**
    Copiez le fichier d'exemple `.env.example` et renommez la copie en `.env`. Ouvrez ensuite ce nouveau fichier `.env` et configurez les variables d'accès à la base de données. Vérifiez que les informations suivantes correspondent à votre environnement local :

    -   `DB_HOST` (ex: `127.0.0.1`)
    -   `DB_PORT` (ex: `8889` pour MAMP, ou autre si vous avez une config différente)
    -   `DB_DATABASE` (doit être `noe_crea_dev_rendu`)
    -   `DB_USERNAME` (ex: `root`)
    -   `DB_PASSWORD` (ex: `root`)

    Exemple de configuration dans le fichier `.env` :

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=8889
    DB_DATABASE=noe_crea_dev_rendu
    DB_USERNAME=root
    DB_PASSWORD=root
    ```

    **Note :** Adaptez `DB_HOST`, `DB_PORT`, `DB_USERNAME`, et `DB_PASSWORD` à votre configuration spécifique.

4.  **Installation des Dépendances et Initialisation**
    Assurez-vous d'être à la racine du projet dans votre terminal. Exécutez les commandes suivantes dans l'ordre indiqué. Certaines commandes peuvent sembler redondantes, mais des phases de débogage ont prouvé leur utilité pour une installation fonctionnelle :

    -   Installation des dépendances JavaScript/CSS :
        ```bash
        npm install
        ```
    -   Installation des dépendances PHP (Laravel et paquets associés) :
        ```bash
        composer install
        ```
    -   Création de la structure de la base de données (tables) et suppression des données existantes :
        ```bash
        php artisan migrate:fresh
        ```
    -   Remplissage de la base de données avec des données initiales (seeders) :
        ```bash
        php artisan db:seed
        ```
    -   Création des répertoires pour le stockage des fichiers uploadés (images des acteurs et affiches de films) :
        ```bash
        mkdir -p storage/app/public/actors storage/app/public/posters
        ```
    -   Suppression d'un éventuel lien symbolique de stockage existant :
        ```bash
        php artisan storage:unlink
        ```
    -   Création du lien symbolique pour rendre les fichiers du répertoire `storage/app/public` accessibles publiquement via `public/storage` :
        ```bash
        php artisan storage:link
        ```
    -   Compilation des assets front-end (CSS, JS) et lancement du serveur de développement Vite :
        ```bash
        composer run dev
        ```

    ```
    Par défaut, le site sera accessible à l'adresse : http://localhost:8000
    ```

---

## II. Exploration du Site Web

Le site propose différentes fonctionnalités selon que l'utilisateur est un simple visiteur ou un utilisateur authentifié. La navigation principale s'effectue via la barre de navigation (navbar).

### A. Mode Visiteur (Non Connecté)

Commencez par explorer le site sans vous connecter ni vous inscrire afin de vérifier les fonctionnalités accessibles publiquement.

1.  **Page d'Accueil**

    -   Affiche les 10 derniers films ajoutés.
    -   Présente les 10 derniers acteurs enregistrés.
    -   En faisant défiler la page, les 10 prochaines séances (showtimes) sont visibles.

2.  **Section "Artists"**

    -   Accessible via le lien "Artists" dans la navbar.
    -   Affiche une liste paginée des artistes sous forme de tableau.
    -   En tant que visiteur, le bouton de création d'artiste n'est pas visible.
    -   Il est possible de naviguer entre les pages de la liste ou de cliquer sur le nom de famille d'un artiste (par exemple, "Coppola", "Lynch") pour accéder à sa fiche détaillée.
    -   La fiche d'un artiste affiche les informations le concernant, ainsi que les films où il est crédité comme réalisateur et ceux dans lesquels il a joué. (Note : Les noms sont générés aléatoirement par la librairie Faker).
    -   Un bouton "View" sur la fiche d'un artiste, à côté d'un film, permet d'accéder directement à la page de ce film.

3.  **Section "Movies"**

    -   Accessible via le lien "Movies" dans la navbar.
    -   Présente une liste paginée de films sous forme de tableau, avec diverses informations.
    -   Cliquer sur le titre d'un film mène à sa page de détails.

4.  **Section "Countries"**

    -   Accessible via le lien "Countries" dans la navbar.
    -   Liste les pays prédéfinis dans les fichiers de "seeding" (données initiales).

5.  **Section "Cinemas"**

    -   Accessible via le lien "Cinemas" dans la navbar.
    -   Affiche une liste de cinémas avec leur adresse.
    -   Cliquer sur le nom d'un cinéma permet de voir sa page de détails.
    -   Sur la page de détail d'un cinéma, un bouton "View Rooms" permet de visualiser les salles associées à ce cinéma, leur capacité, et un bouton d'action pour voir les séances programmées dans chaque salle.

6.  **Section "Rooms"**

    -   Accessible via le lien "Rooms" dans la navbar.
    -   Affiche une liste de toutes les salles de cinéma enregistrées dans le système.

7.  **Section "Showtimes"**
    -   Accessible via le lien "Showtimes" dans la navbar.
    -   Affiche les séances programmées, classées par ordre chronologique (les plus proches en premier).

### B. Mode Utilisateur Connecté

Pour tester les fonctionnalités réservées aux utilisateurs authentifiés, il faut d'abord créer un compte.

1.  **Inscription (Register)**

    -   Cliquez sur le bouton "Register" dans la navbar.
    -   Remplissez le formulaire d'inscription. Exemple de données :
        -   Name: `Admin`
        -   Email: `Admin@mail.com`
        -   Password: `Admin2025`
        -   Confirm Password: `Admin2025`
    -   Après une inscription réussie, vous serez redirigé vers le tableau de bord (Dashboard).

2.  **Tableau de Bord (Dashboard)**

    -   Le tableau de bord est actuellement minimaliste.
    -   Cliquez sur le bouton "View Showtimes" pour être redirigé vers la liste des séances.

3.  **Fonctionnalités CRUD (Create, Read, Update, Delete)**

    -   **Gestion des Artistes ("Artists")**

        -   Retournez à la section "Artists" via la navbar.
        -   Un nouveau bouton "Add new artist" est désormais visible. Cliquez dessus.
        -   Remplissez le formulaire de création d'artiste.
            -   **Important :** L'image de l'artiste ne doit pas dépasser 2048kb (2MB).
        -   Après avoir cliqué sur "Create Artist", le nouvel artiste apparaîtra en premier dans la liste.
        -   Vous pouvez cliquer sur son nom pour voir sa fiche.
        -   **Note :** Pour ajouter un artiste au casting d'un film, il faut le faire depuis la fiche du film concerné, et non depuis la fiche de l'artiste.
        -   Des options pour modifier (Edit) et supprimer (Delete) l'artiste sont disponibles sur la ligne de l'artiste dans le tableau ou sur sa fiche. La suppression le fera disparaître de la liste.

    -   **Gestion des Films ("Movies")**

        -   Le processus est similaire à celui des artistes : un bouton "Add new movie" permet d'accéder à un formulaire de création.
        -   Les films créés peuvent être consultés, modifiés et supprimés.

    -   **Gestion des Pays ("Countries")**

        -   Le processus de création, modification et suppression est également disponible.
        -   Il n'y a pas de page de "détail" (show) pour les pays, car toutes les informations pertinentes sont déjà affichées dans la liste.

    -   **Gestion des Cinémas ("Cinemas")**

        -   Le processus de création, modification et suppression des cinémas est disponible.
        -   Une différence notable se situe dans la gestion des salles :
            -   Dans la liste des cinémas, la colonne "Actions" à droite permet de cliquer sur "View rooms" pour voir les salles d'un cinéma.
            -   Si vous avez créé un cinéma, en accédant à "View rooms" pour ce cinéma spécifique, un bouton "Add New Room" apparaîtra, vous permettant d'ajouter des salles directement à ce cinéma.

    -   **Gestion des Salles ("Rooms")**

        -   En cliquant sur "Rooms" dans la navbar, un bouton "Add new room" est visible.
        -   Cliquer sur ce bouton redirige vers un formulaire qui nécessite de sélectionner un cinéma auquel la salle sera rattachée (on ne peut pas créer une salle sans l'associer à un cinéma existant).

    -   **Gestion des Séances ("Showtimes")**
        -   Le lien "All showtimes" (ou la section "Showtimes" de la navbar) affiche toutes les séances. Des fonctionnalités de création/gestion de séances pour les utilisateurs connectés (administrateurs) sont également prévues dans cette section.

4.  **Déconnexion (Log Out)**
    -   Cliquez sur votre nom d'utilisateur (par exemple, "Admin") en haut à droite de la navbar. Cela peut vous mener au "Dashboard" ou ouvrir un menu déroulant.
    -   Sur la page du Dashboard (ou dans le menu déroulant), cliquez sur l'option "Log Out".
    -   Vous serez alors déconnecté et retournerez en mode visiteur.

---
