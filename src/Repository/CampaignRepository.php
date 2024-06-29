<?php

namespace App\Repository;

use App\Entity\Campaign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Campaign>
 *
 * @method Campaign|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campaign|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campaign[]    findAll()
 * @method Campaign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

// Cette classe est utilisée pour les requêtes de la table Campaign
class CampaignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campaign::class);
    }

    //    /**
    //     * @return Campaign[] Returns an array of Campaign objects
    //     */

    // Permet d'afficher les campagnes auquel participe un joueur
    public function findByCharacterId($characterId)
    {
        return $this->createQueryBuilder('campaign')
            ->innerJoin('campaign.player', 'character')
            ->andWhere('character.id IN (:characterId)')
            ->setParameter('characterId', $characterId)
            ->select('campaign.id', 'campaign.name')
            ->addSelect('character.name as playerName')
            ->getQuery()
            ->getResult();
    }


 /**
 *
 * @param [type] $campaignId
 * @return void
 */

    // Permet d'afficher les campagnes créer par un utilisateur (sans qu'il soit joueur)
    public function findByGameMasterId($userId)
    {
        return $this->createQueryBuilder('campaign')
        ->innerJoin('campaign.gameMaster', 'campaign_user')
        ->andWhere('campaign_user.id IN (:userId)')
        ->setParameter('userId', $userId)
        ->select('campaign.id', 'campaign.name')
        ->addSelect('campaign_user.pseudo as playerName')
        ->getQuery()
        ->getResult();
    }

}
