# Donj'O et Drag'O

## Objectifs du projet:

Créer un site de support pour jouer à Donjons et Dragons.

La V1 permettra de se créer un compte puis de créer un personnage.

La V2 permettra de créer une campagne et de gérer les ennemis et affrontements.

## Installation du projet

- composer install --no-dev --optimize-autoloader
- git clone le projet
- créer un .env.local
- changer nom de la base de données
- php bin/console doctrine:database:create
- php bin/console doctrine:migration:migrate
- php bin/console asset-map:compile

Au besoin faire les fixtures en dev.

## Contributeurs :

- Cyprien Vallée
- Laurent Becker
- Manuel Folliot
- Sébastien Adam
- Arbi Mootez Trabelsi

Réalisé avec Symfony, MariaDB, Turbo, Stimulus JS et passion.
