# Journal de bord perso

## jeudi 21 mars

- figma wireframe mobile accueil + header footer
- figma proposition de design + page guides style

## lundi 25 mars

- figma wireframe création campagne

## mardi 26 mars

- creation des styles

## mercredi 27 mars

- clonage projet
- installation squelette projet Symfony
- debuggage serveur PHP Manuel (reinit du VirtualHost 000-default.conf)
- création entités et migration BDD

Documentation sur installation [Tailwind dans Symfony](https://symfonycasts.com/screencast/symfony/tailwindcss), AssetMapper.

## Jeudi 28 mars

- choix méthode d'installation [Tailwind Symfony](https://symfony.com/bundles/TailwindBundle/current/index.html)
- installation Tailwind dans Symfony
- création template twig + footer
- effet flamme sur texte suite à galère pour text clip single letter [ref](https://www.epicweb.dev/tips/text-and-image-clipping-effects)

## Vendredi 29 mars

- création [twig component](https://symfony.com/bundles/ux-twig-component/current/index.html) pour boutton
- [security bundle](https://symfony.com/doc/current/security.html)
- utilisation alias pour la table `character` car réservée par SQL
- customisation des [twig forms](https://symfony.com/doc/current/form/form_customization.html)

## samedi 30 mars

- mise en forme selection race/job/alignement
- merge branch back

## mardi 02 avril

- refacto js en utilisant les [target](https://stimulus.hotwired.dev/reference/targets) et data action de stimulus

## mercredi 03 avril

- debug back login page, hashage de password et 
- reponsive layout
- burger/sword icon animation

## Jeudi 04 avril

- amelioration des routes et de la circulation
- deployement:
  
  - connexion ssh
  - maj paquets
  - clone projet
  - creation bdd + user
  - config .env.local
  - composer install
  - compilation tailwind `php bin/console tailwind:build --minify`
  - compilation des assets `php bin/console asset-map:compile`
  - install `composer require symfony/apache-pack` pour réécriture liens `.htaccess`

## Vendredi 05 avril

- formulaire création de personnage
- stimulus controller

## Lundi 08 avril

- présentation du projet
- continu sur le formulaire twig/stimulus
- modification du sélecteur avatar pour utilisation en user et character

## Mardi 09 avril

- conflit de migration
- finalisation formulaire création personnage

## Mercredi 10 avril

- creation entity Campaign (et relations) + Crud
- mise en page crud campaign

## Jeudi 11 avril

- dynamisation buttons de selections d'action page campagne show
- utilisation turbo-frame
- amélioration de l'outil de lancé de dés

## Vendredi 12 avril

- turbo frame personage (bascule entre stats basics et avancés )
- débugage querybuilder d'affichage des campagnes d'un utilisateur 
-

## Samedi 13 avril

- utilisation des twig live components pour mise à jour des points de vie en BDD sur la page Campagne. [ref](https://symfony.com/bundles/ux-live-component)
- utilisation de debounce sur le twig template lors de l'appel de function pour éviter trop d'appel en bdd

## Lundi 15 avril

- présentation de l'avancement du projet
- refonte de la page new user en livecomponent
- Doc sur futures fonctionnalités live update page pour les utilisateurs connectés [mercure](https://symfonycasts.com/screencast/turbo/mercure)

## Mardi 16 avril

- abandon de la page new user en livecomponent à cause du bug validation sur type Repeated password (pas de empty_data disponible sur ce type)
- retravail sur la page creation/edition character

## Mercredi 17 avril

- finalisation de la page création/édition character
- ajout d'un initpool paramètre pour le mettre à 0 en cas d'édition d'un character
- suppression des `data` sur création des forms (empêche la mise à jour des données sur l'edition), utilisation des données par défaut dans les Entity.
- création CRUD pour pages alignements, race et classes Hero
- mise en forme et style CRUD
- mise à jour security.yaml pour accès à ces pages uniquement pour les admins

## Jeudi 18 avril

- aide back sur récupération des campagnes gameMaster sur la page profil (query builder, requête sql personnalisée)
- refactorisation controller stimulus selection avatar et selection de l'avatar si edition page.
- stylisation mineure (hover bouton, ...)
- mise à jour de la prod.

### Etapes

- `sudo apt update && sudo apt upgrade`
- `cd /var/www/html/dunjo`
- `git pull`
- supprimer les anciennes migration et forcer la restructuration de la database: `symfony console doctrine:schema:drop --force`
- `composer install --no-dev` (verifier pourquoi le faker s'installe)
- 