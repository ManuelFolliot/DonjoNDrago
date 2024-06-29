<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// Cette classe est utilisé pour définir les campagnes
#[ORM\Entity(repositoryClass: CampaignRepository::class)]
class Campaign
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Merci de nommer votre campagne.')]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    // On définit une relation ManyToMany avec la classe User
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'gamemaster')]
    private Collection $gameMaster;

    // On définit une relation ManyToMany avec la classe Character
    #[ORM\ManyToMany(targetEntity: Character::class, inversedBy: 'campaigns')]
    private Collection $player;

    public function __construct()
    {
        $this->gameMaster = new ArrayCollection();
        $this->player = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getGameMaster(): Collection
    {
        return $this->gameMaster;
    }

    public function addGameMaster(User $gameMaster): static
    {
        if (!$this->gameMaster->contains($gameMaster)) {
            $this->gameMaster->add($gameMaster);
        }

        return $this;
    }

    public function removeGameMaster(User $gameMaster): static
    {
        $this->gameMaster->removeElement($gameMaster);

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getPlayer(): Collection
    {
        return $this->player;
    }

    public function addPlayer(Character $player): static
    {
        if (!$this->player->contains($player)) {
            $this->player->add($player);
        }

        return $this;
    }

    public function removePlayer(Character $player): static
    {
        $this->player->removeElement($player);

        return $this;
    }

}
