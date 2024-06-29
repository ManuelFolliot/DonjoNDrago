<?php

namespace App\DataFixtures;

use App\Entity\Alignment;
use App\Entity\Campaign;
use App\Entity\Character;
use App\Entity\Job;
use App\Entity\Race;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

// On crée une classe qui va nous permettre de générer des données fictives
class AppFixtures extends Fixture
{
    // On ajoute le passwordHasher pour pouvoir hasher les mots de passe    
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // On instancie Faker   
        $faker = Factory::create();
        // On fixe la seed pour avoir des données cohérentes
        $faker->seed(1234);
        
        $users = [
            [
                "email" => "",
                // password user
                "password" => "user",
                "role" => ["ROLE_USER"],
                "pseudo" => "User",
                "user_avatar_url" => "",
            ],
            [
                "email" => "",
                // password admin
                "password" => "admin",
                "role" => ["ROLE_ADMIN"],
                "pseudo" => "Admin",
                "user_avatar_url" => "",
            ]
        ];

        
        $userList = [];
        $nbUser = $faker->numberBetween(3, 6);
        foreach ($users as $userData){
            for ($currentUser = 0; $currentUser < $nbUser; $currentUser++){
            $user = new User;
            $user->setEmail($faker->email());
            $user->setPassword($this->passwordHasher->hashPassword($user, $userData["password"]));
            $user->setRoles($userData["role"]);
            $user->setPseudo($userData["pseudo"]);
            $user->setUserAvatarUrl('avatar'.$faker->numberBetween(1, 6).'.svg');
            $userList[] = $user;
            $manager->persist($user);
            }
        }

        $alignment = [
            [
                "name" => "Mauvais",
                "description" => "Quelqu'un de mauvais sera malhonnête, égoïste, cruel et destructeur. La vie des autres a peu d'importance à ses yeux. 
                Une chose meurt, une autre naîtra, peu importe. Se sacrifier personnellement pour une cause est par contre un acte inexplicable..",
            ],
            [
                "name" => "Chaotique",
                "description" => "Rebelle, intuitif, informel, individualiste et progressiste dans sa manière de voir les choses. Cela n'est lié d'aucune sorte à la morale ou à la légalité. Chaotiques mais bons, cela signifie simplement, et avant tout, la liberté. L'absence de codes formels et écrits, mais compensée par une bonté naturelle et une morale, fait que l'ensemble ne dérive pas vers un monde de brutes et de non-respect des autres. Pour une tribu d'orcs par contre, également chaotiques mais mauvais, 
                cela débouche bel et bien sur un réel chaos où chacun fait ce qu'il veut, car aucune barrière morale ne sert de limite..",
            ],
            [
                "name" => "Neutre",
                "description" => "Un personnage neutre se situe entre le bien et le mal. Mais cela peut être un neutre passif (qui laisse faire sans jamais prendre parti d'un côté ou de l'autre) ou bien un neutre actif, 
                qui lui au contraire lutte fortement afin qu'aucune des deux parties ne prenne le dessus sur l'autre, l'équilibre dans toutes choses étant à ses yeux primordial.",
            ],
            [
                "name" => "Bon",
                "description" => "Un personnage bon est honnête, généreux, miséricordieux et constructeur. La vie d'autrui ne s'ôte pas pour de futiles raisons. Par contre le sacrifice de sa propre personne pour le bien de tous n'est pas une chose qui doit faire peur. 
                Détruire, que ce soit une vie ou un lieu, est un acte négatif qui devra toujours être bien pensé afin d'être sûr qu'il soit nécessaire d'être entreprit",
                ]
            ];


            $alignmentList = [];
            // On boucle sur les données pour les insérer en base
            foreach ($alignment as $alignmentData) {
                $alignment = new Alignment;
                $alignment->setName($alignmentData["name"]);;
                $alignment->setDescription($alignmentData["description"]);
                $alignmentList[] = $alignment;
                $manager->persist($alignment);
            }
        
        $job = [
            [
                "name" => "Barbare",
                "description" => "Vous aimez foncer dans le tas sans trop réfléchir, vous encaisser et donnez bien les coups mais on ne compteras pas sur vous pour élaborer une stratégie, comme dirait le barbare du Donjon de Naheulbeuk: Baston !",
                "jobUrl" => "barbarian.png"
            ],
            [
                "name" => "Druide",
                "description" => "Vous n'êtes pas vraiment fait pour la bataille mais êtes un personnage des plus importants en tant que soutien. Potions, soins, Buff de dégât ou de magie, vous êtes la pour épauler et soutenir votre équipe.",
                "jobUrl" => "druid.png"
            ],
            [
                "name" => "Magicien",
                "description" => "Indispensable sur un champ de bataille mais pas très doué au combat physique. Vous misez tout sur vos pouvoirs et restez à distance de l'ennemi.",
                "jobUrl" => "wizard.png"
            ],
            [
                "name" => "Guerrier",
                "description" => "Vous êtes un combattant hors pair, vous encaissez et donnez des coups comme personne. Vous êtes le premier à foncer dans la mêlée et le dernier à en sortir.",
                "jobUrl" => "fighter.png"
            ],
            [
                "name" => "Barde",
                "description" => "Vous êtes un personnage charismatique qui sait se faire apprécier de tous. Vous êtes un soutien de choix pour votre équipe et savez vous battre si besoin.",
                "jobUrl" => "bard.png"
            ]
            ];

            $jobList = [];
        foreach ($job as $jobData){
            $job = new Job;
            $job->setName($jobData["name"]);
            $job->setDescription($jobData["description"]);
            $job->setJobUrl($jobData["jobUrl"]);
            $jobList[] = $job;
            $manager->persist($job);
        }
        
        $race =[
            [
                "name" => "Humain",
                "description" => "Vous êtes un humain, que voulez vous dire de plus ?",
                "raceUrl" => "human.png"
            ],
            [
                "name" => "Elfe",
                "description" => "Vous êtes un elfe, vous vivez dans la fôret des elfes sylvains et vous avez de grandes oreilles.",
                "raceUrl" => "elf.png"
            ],
            [
                "name" => "Orc",
                "description" => "Vous êtes un orc, vous vivez nu, vous puez et vous ne savez pas parler.",
                "raceUrl" => "orc.png"
            ],
            [
                "name" => "Nain",
                "description" => "Vous êtes un nain, vous êtes petit, vous avez une barbe et vous aimez l'or.",
                "raceUrl" => "dwarf.png"
            ],
            [
                "name" => "Gnome",
                "description" => "Vous êtes un gnome, vous êtes petit, vous avez une barbe et vous aimez les machines.",
                "raceUrl" => "gnome.png"
            ]
            ];

        $raceList = [];
        foreach ($race as $raceData){
            $race = new Race;
            $race -> setName($raceData["name"]);
            $race -> setDescription($raceData["description"]);
            $race -> setRaceUrl($raceData["raceUrl"]);
            $race -> setStrengthModifier($faker->numberBetween(-2,2));
            $race -> setDexterityModifier($faker->numberBetween(-2,2));
            $race -> setEnduranceModifier($faker->numberBetween(-2,2));
            $race -> setIntelligenceModifier($faker->numberBetween(-2,2));
            $race -> setWisdomModifier($faker->numberBetween(-2,2));
            $race -> setCharismaModifier($faker->numberBetween(-2,2));
            $raceList[] = $race;
            $manager->persist($race);
        }

        $nbHero = 7;
            for ($currentHeroNumber = 0; $currentHeroNumber < $nbHero; $currentHeroNumber++) {
            $hero = new Character;
            $hero->setName($faker->name());;
            $hero->setCharacterAvatarUrl('avatar'.$faker->numberBetween(1, 6).'.svg');
            $hero->setLevel($faker->numberBetween(1, 20));
            $hero->setLifepoints($faker->numberBetween(4, 240));
            $hero->setAge($faker->numberBetween(1, 500));
            $hero->setBackground($faker->text());;
            $hero->setStatStrength($faker->numberBetween(1, 20));
            $hero->setStatDexterity($faker->numberBetween(1, 20));
            $hero->setStatEndurance($faker->numberBetween(1, 20));
            $hero->setStatIntelligence($faker->numberBetween(1, 20));
            $hero->setStatWisdom($faker->numberBetween(1, 20));
            $hero->setStatCharisma($faker->numberBetween(1, 20));
            $hero->setAlignment($alignmentList[$faker->numberBetween(0, count($alignmentList)-1)]);
            $hero->setJob($jobList[$faker->numberBetween(0, count($jobList)-1)]);
            $hero->setRace($raceList[$faker->numberBetween(0, count($raceList)-1)]);
            $hero->setUser($userList[$faker->numberBetween(0, count($userList)-1)]);
            $manager->persist($hero);
            }

            $campaign = [
                [
                    "name" => "",
                ],
            ];

        $nbCampaign = 2;
        for ($currentCampaignNumber = 0; $currentCampaignNumber < $nbCampaign; $currentCampaignNumber++) {
        $campaign = new Campaign;
        $campaign->setName($faker->name());;
        $manager->persist($campaign);
        }

        // On envoie les données en base
        $manager->flush();
    }
}

