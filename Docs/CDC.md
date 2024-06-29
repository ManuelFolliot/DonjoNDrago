# Cahier des charges du projet

## Contexte :
### Proposition de site : prOjet Donj'O et Drag'O
Le but est de proposer un site permettant d'animer et de participer à une campagne de jeu de rôle type Donjons et Dragons

### Délai
Trois semaines, jusqu'au 21 avril.

## Spécificités fonctionnelles :
### Apparence : 
Ambiance médiéval-fantasy
Site responsive, desktop-first

### types d'usagers :
  Public mature (16+)
  Francophone (une version anglophone existe déjà mais pas traduite en français)
  Accessibilité aux personnes en situation de handicap
  
### fonctionnalités :
  Créer un compte
  Choix du Jeu de Rôle
  Création d'une campagne => donne au user le role MJ
    - Features : 
        - ajout de joueurs qui verront les infos => serveur privé
        - partage d'images et de musiques (libre de droit évidemment) proposées d'avance

  Création d'un personnage => donne au user le rôle Joueur
      - Création du personnage (l'aspect le plus long)
      - Suppression du personnage
      
  Simulation de combat :
          - sélection d'un type d'ennemi (simple, type lapin adulte ou faisan, pas de gestion de magie) et du nombre puis validation (côté MJ)
          - gestion des jets de combat => indique la réussite ou l'échec (côté MJ et joueur)
          - retirer un ennemi du combat (si pv à 0 ou fuite) (côté MJ)

### MVP :
  Créer un compte, un personnage et une campagne

### User stories V1 :
#### Accueil
| En tant que | Je veux | Afin de (si besoin/nécessaire) |
|--|--|--|
| visiteur | pouvoir visualiser la première page du site | voir ce que propose le site |
| visiteur | créer un compte | afin d'accéder aux fonctionnalités complètes du site |
| visiteur | me connecter | - |

#### Profil
| En tant que | Je veux | Afin de (si besoin/nécessaire) |
|--|--|--|
| utilisateur | lister mes personnages | accéder rapidement à tout ce que j'ai créé |
| utilisateur | consulter la fiche d'un personnage | voir à quoi ressemble la fiche de mon personnage |
| utilisateur | créer un personnage | - |
| utilisateur | supprimer un personnage | - |
| utilisateur | me déconnecter | - |
| utilisateur | modifier mon compte (avatar, mdp, etc)  | - |

### User stories V2 :

#### User
| En tant que | Je veux | Afin de (si besoin/nécessaire) |
|--|--|--|
| utilisateur | rejoindre une campagne en cours | - |
| utilisateur | lister mes campagnes | - |
| utilisateur | créer une campagne | - |
| utilisateur | ajouter des joueurs à une campagne | - |

#### Campagne
| En tant que | Je veux | Afin de (si besoin/nécessaire) |
|--|--|--|
| joueur | lancer un ou plusieurs dés de mon choix | - |
| joueur | accéder en un clic à ma fiche de personnage (pop up version Desktop, tout l'écran en version mobile) | - |
| joueur | voir les ennemis | - |
| MJ | ajouter des ennemis | - |
| MJ | retirer des ennemis en un clic | - |
| MJ | changer l'image d'ambiance | - |
| MJ | changer la musique d'ambiance | - |
| MJ | lancer un ou plusieurs dés de mon choix | - |
| MJ | accéder en un clic aux fiches de personnage des joueurs | - |

### User stories V3
#### Accueil
| En tant que | Je veux | Afin de (si besoin/nécessaire) |
|--|--|--|
| Visiteur | lire les news | connaître l'actualité du site |

#### BackOffice
| En tant que | Je veux | Afin de (si besoin/nécessaire) |
|--|--|--|
| Admin | bannir un utilisateur | - |
| Admin | supprimer un utilisateur | - |
| Admin | modifier les informations d'un utilisateur | - |
| Admin | supprimer un ou plusieurs mots de passe d'utilisateur | - |
| Admin | ajouter des ressources pour les utilisateurs (musique, images, ennemis, etc) | - |
| Admin | ajouter des news | - |

### User stories V4
#### Paramètres
| En tant que | Je veux | Afin de (si besoin/nécessaire) |
|--|--|--|
| utilisateur | supprimer mon compte  | - |
| utilisateur | ajouter des utilisateurs en amis | les garder en contact |
| utilisateur | envoyer des MP à des utilisateurs | - |
| utilisateur | bloquer les messages d'un utilisateur | - |

### Arborescence :

![Arborescence](https://github.com/O-clock-Jelly/projet-14-donj-o-et-drag-o/blob/main/Arborescence%20du%20site.png "Arborescence DonjO et DragO")

### Navigation :
  Une page d'accueil présentant le site, une nav bar qui permet de login/logout ou de s'inscrire
  Une page personnelle permettant de voir ses personnages et ses campagnes en cours, de créer un personnage ou une campagne
  On clique sur créer une campagne pour afficher un écran demandant le nom qu'on veut donner à la campagne et les joueurs qu'on veut inviter
  On clique sur créer un personnage pour changer de page et créer son personnage de A à Z. On peut revenir en arrière à n'importe quel moment

### Templates / Charte graphique
  #### Layout global
  Un menu avec Titre, une icone de l'utilisateur, et un bouton connexion et déconnexion
  En background, une image de fantasy libre de droit
  Pied de page avec Nous contacter, Mentions légales, Liens vers des réseaux sociaux

  #### page campagne

  #### page création de personnage


### Contraintes techniques
  Site responsive en desktop first
  Compatibilité uniquement avec les dernières versions des navigateurs
  
## Spécifications techniques :
  ### Langages utilisés
    Technos front : HTML/CSS, JavaScript, Twig, TailWind
    Technos back : Symphony, PHP, MariaDb
    Versionning : Git
  ### Description des données
    User : pseudo, email, mdp, avatar (optionnel)
    Personnage : nom, avatar, race, force, dextérité, intelligence, endurance, sagesse, charisme, points de vie, niveau
    Campagne : nom, MJ, joueurs

  ### Routes V1
  #### front
| URL | Description |
|--|--|
| `/` | Page d'accueil |
| `/signin` | Ecran de connexion |
| `/signup` | Page d'inscription |
| `/profil/id` | Page de profil |
| `/character/id` | Fiche de personnage |
| `/character/creation` | Page de création de personnage |

### Routes V2
| `/campaign/id` | Ecran de campagne |
| `/campaign/creation` | Page de création de campagne |

### Routes V3
#### front
| URL | Description |
|--|--|
| `/news` | Page des news |

#### back
| URL | Description |
|--|--|
| `/admin/` | page accueil administration |
| `/admin/users` | page gestion des utilisateurs(bannir, définition des rôles, etc) |
| `/admin/assets` | page gestion des assets (musiques, image, ennemis, classes, races) |
| `/admin/campaigns` | page gestion des campagnes |
| `/admin/characters` | page gestion des personnages |
| `/admin/news` | page gestion des news |

### Routes V4
| URL | Description |
|--|--|
| `/profil/id/parameters` | page de modification du profil (mdp, avatar,etc) |
  
## Les rôles de chacun :
  - Product Owner : Manuel
  - Lead Dev Front : Manuel
  - Lead Dev Back : Cyprien
  - Git Master : Sébastien
  - Scrum Master : Cyprien
  - Développeur : Manuel, Sébastien, Arbi, Cyprien, Laurent
