# Journal de bord de Donj'O et Drag'O
## 18/03/2024, Sprint 0
Nous avons préparé le cahier des charges et défini la plupart des objectifs. Il nous reste à définir le layout et l'arborescence.
Cette semaine, nous allons avancer sur les wireframes (desktop et mobile), le MCD/dico de données/MLD/MPD, le layout et l'arborescence.
Wireframes réalisées sur Figma. Dimensions Android Small (360x640) pour la version mobile, Ipad (744x1133) pour la version tablette, Desktop (1440x1024) pour la version desktop.

## 25/03/2024, Sprint 0
Définition des user stories.
Définition des routes dans le CDC à destination du client.
Bases du layout posées.

## 26/03/2024, Sprint 0

Validation wireframes V1, desktop et mobile.
Validation MCD, MLD et MPD V1.
Validation des rôles.
Validation des technos.

## 27/03/2024, Sprint 0

- Mise en place du code.
  - commandes exécutées :

     => création de la branche sur laquelle les merge auront lieu
     
     ```bash
     git checkout -b dev 
     ```

     => installation de Symfony
     
     ```bash
      curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
     sudo apt install symfony-cli 
     ```

     => installation du squelette

     ```
        symfony new DnD --webapp
     ```

    => lance un serveur Symfony

    ```bash
    symfony serve -d
    ```

    => création des entités

    ```bash
    php bin/console make:entity
    ```

   => permet de créer des User de manière sécurisé en gérant les permissions

     ```bash
     composer require symfony/security-bundle 
     ```

     => permet de créer des User

     ```bash
     php bin/console make:user 
     ```

     => creation de la base de données

     ```bash
     php bin/console doctrine:database:create
     ```

     => creations des migrations

     ```bash
     php bin/console make:migration
     ```

     => lancement des migrations

     ```bash
     php bin/console doctrine:migration:migrate
     ```



- Création des entités Character, Race, Alignment et Job (remplace Class car nom réservé)
- Mise en place de l'authentification (avec User)
- Création d'un fichier `.env.local`
- Configuration des accès à la BDD
- Création des branches


### Répartition des tâches pour le sprint 1:

- Team Front : Manuel, Seb, Arbi 
  
  - Créer la page d'accueil (priorité 2)
  - Créer la page de connexion (priorité 1)
  - Créer la page d'inscription (priorité 1)
  - créer la page profil (priorité 2)
  - créer la page paramètre (priorité 2)
  - créer la page création de personnage (priorité 3)

- Team Back : Cyprien, Laurent
  
  - Création d'un nouvel utilisateur (CRUD) (Priorité 2)
  - vérication des données et de la sécurité (hâchage) (Priorité 2)
  - création des routes et controllers (priorité 1)
  - Création d'un nouveau personnage (priorité 3)
  
### Répartition des tâches pour le sprint 2:

- Team Front : Manuel, Seb, Arbi 
  
  - Créer la page création de campagne
  - Créer la page campagne version Joueur
  - Créer la page campagne version MJ

- Team Back : Cyprien, Laurent
  - Création d'une campagne
  - Création outils du MJ :
    - lancer de dés
    - ajout d'un ennemi
    - suppression d'un ennemi
    - changer image de fond
  - édition d'une campagne


## 05/04/2024, Sprint 1
Déploiement de l'application réussie.

## 08/04/2024, Sprint 2
Commandes pour écraser la BDD :
- `symfony console doctrine:schema:drop --force`
- Puis migration et migrate.

Rétrospective Sprint 1 devant les autres groupes.
Visite des helpers pour aider sur la création d'un compte.

## 09/04/2024, Sprint 2
Début travail campagne.

## 10/04/2024, Sprint 2
Refacto de la BDD car souci de relations

## 18/04/2024, Sprint 3
Finition features

## 19/04/2024, Sprint 3
Déploiement application