<?php

namespace App\Repository;

use App\Entity\Character;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Character>
 *
 * @method Character|null find($id, $lockMode = null, $lockVersion = null)
 * @method Character|null findOneBy(array $criteria, array $orderBy = null)
 * @method Character[]    findAll()
 * @method Character[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Character::class);
    }

    //    /**
    //     * @return Character[] Returns an array of Character objects
    //     */
    
    // Permet d'afficher les personnages d'un utilisateur
    public function findByUserId($userId)
    {
        // On récupère les personnages de l'utilisateur
        return $this->createQueryBuilder('hero')

        // On fait une jointure avec la table user
            ->innerJoin('hero.user', 'user')
            ->andWhere('user.id = :userId')
            ->setParameter('userId', $userId)
            ->select('hero.id', 'hero.name', 'user.id as user_id', 'user.email')
            ->getQuery()
            ->getResult();
    }

}
