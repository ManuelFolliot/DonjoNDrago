<?php

namespace App\Entity;

use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

// Cette classe est utilisé pour définir la Race des personnages
#[ORM\Entity(repositoryClass: RaceRepository::class)]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $strengthModifier = null;

    #[ORM\Column]
    private ?int $dexterityModifier = null;

    #[ORM\Column]
    private ?int $enduranceModifier = null;

    #[ORM\Column]
    private ?int $intelligenceModifier = null;

    #[ORM\Column]
    private ?int $wisdomModifier = null;

    #[ORM\Column]
    private ?int $charismaModifier = null;

    // On définit une relation OneToMany avec la classe Character
    #[ORM\OneToMany(targetEntity: Character::class, mappedBy: 'race')]
    private Collection $characters;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $raceUrl = null;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getStrengthModifier(): ?int
    {
        return $this->strengthModifier;
    }

    public function setStrengthModifier(int $strengthModifier): static
    {
        $this->strengthModifier = $strengthModifier;

        return $this;
    }

    public function getDexterityModifier(): ?int
    {
        return $this->dexterityModifier;
    }

    public function setDexterityModifier(int $dexterityModifier): static
    {
        $this->dexterityModifier = $dexterityModifier;

        return $this;
    }

    public function getEnduranceModifier(): ?int
    {
        return $this->enduranceModifier;
    }

    public function setEnduranceModifier(int $enduranceModifier): static
    {
        $this->enduranceModifier = $enduranceModifier;

        return $this;
    }

    public function getIntelligenceModifier(): ?int
    {
        return $this->intelligenceModifier;
    }

    public function setIntelligenceModifier(int $intelligenceModifier): static
    {
        $this->intelligenceModifier = $intelligenceModifier;

        return $this;
    }

    public function getWisdomModifier(): ?int
    {
        return $this->wisdomModifier;
    }

    public function setWisdomModifier(int $wisdomModifier): static
    {
        $this->wisdomModifier = $wisdomModifier;

        return $this;
    }

    public function getCharismaModifier(): ?int
    {
        return $this->charismaModifier;
    }

    public function setCharismaModifier(int $charismaModifier): static
    {
        $this->charismaModifier = $charismaModifier;

        return $this;
    }

    /**
     * @return Collection<int, Character>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): static
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setRace($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getRace() === $this) {
                $character->setRace(null);
            }
        }

        return $this;
    }

    public function getRaceUrl(): ?string
    {
        return $this->raceUrl;
    }

    public function setRaceUrl(?string $raceUrl): static
    {
        $this->raceUrl = $raceUrl;

        return $this;
    }
}
