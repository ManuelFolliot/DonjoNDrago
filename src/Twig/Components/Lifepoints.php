<?php

namespace App\Twig\Components;

use App\Entity\Character;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
class Lifepoints
{
    #[LiveProp(writable: true)]
    public int $points;

    #[LiveProp(writable: true)]
    public ?Character $player = null;

    private $characterRepository;
    private $em;

    use DefaultActionTrait;

    public function __construct(CharacterRepository $characterRepository, EntityManagerInterface $em)
    {
        $this->characterRepository = $characterRepository;
        $this->em = $em;
    }

    public function mount(?int $playerId)
    {
        if ($playerId) {
            $this->player = $this->characterRepository->find($playerId);
        }
    }

    #[LiveAction]
    public function increment()
    {
        $this->points++;
        $this->updateLifePoints();
    }

    #[LiveAction]
    public function decrement()
    {
        $this->points--;
        $this->updateLifePoints();
    }

    public function updateLifePoints()
    {
        if ($this->player) {
            $this->player->setLifepoints($this->points);
            $this->em->flush();
        }
    }
}
