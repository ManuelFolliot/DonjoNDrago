<?php

namespace App\Repository;

use App\Entity\Alignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Alignment>
 *
 * @method Alignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alignment[]    findAll()
 * @method Alignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
// Cette classe est utilisée pour les requêtes de la table Alignment
class AlignmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alignment::class);
        
    // On appelle le constructeur de la classe parente
    }
}
