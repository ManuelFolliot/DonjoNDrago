<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

// Cette classe est utilisé pour définir les personnages
#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table (name:"hero")]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Merci de mettre le nom de votre personnage')]
    #[Assert\Length(
        min: 1,
        max: 50,
        minMessage: 'Nom de personnage trop court, minimum attendu 1 caractère.',
        maxMessage: 'Nom de personnage, maximum 50 caractères.',
    )]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $characterAvatarUrl = null;

    #[ORM\Column]
    private ?int $level = 1;
    
    #[ORM\Column]
    private ?int $lifepoints = 20;
    
    #[Assert\NotBlank(message: 'Définir un âge')]
    #[Assert\Length(
        min: 1,
        max: 9999,
     )]
    #[ORM\Column]
    private ?int $age = 22;
    
    #[Assert\NotBlank(message: "Merci d'écrire votre histoire")]
    #[Assert\Length(
        min: 20,
        minMessage: 'Votre histoire doit faire au moins 20 caractères.',
     )]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $background = null;

    #[Assert\NotBlank(message: 'Taper porter, mule life')]
    #[Assert\Range(
        min: 1,
        max: 30,
        notInRangeMessage: 'Vos points de statistiques vont de 1 à 30',
    )]
    #[ORM\Column]
    private ?int $statStrength = 10;
    
    #[Assert\NotBlank(message: 'Agilité esquive souplesse et adresse')]
    #[Assert\Range(
        min: 1,
        max: 30,
        notInRangeMessage: 'Vos points de statistiques vont de 1 à 30',
    )]
    #[ORM\Column]
    private ?int $statDexterity = 10;

    #[Assert\NotBlank(message: 'Définit votre résilience dans l`effort')]
    #[Assert\Range(
        min: 1,
        max: 30,
        notInRangeMessage: 'Vos points de statistiques vont de 1 à 30',
    )]
     #[Assert\Positive]
    #[ORM\Column]
    private ?int $statEndurance = 10;

    #[Assert\NotBlank(message: 'Au minimun 1 point de statistique')]
    #[Assert\Range(
        min: 1,
        max: 30,
        notInRangeMessage: 'Vos points de statistiques vont de 1 à 30',
    )]
    #[ORM\Column]
    private ?int $statIntelligence = 10;

    #[Assert\NotBlank(message: 'Intuition et résistance mentale.')]
    #[Assert\Range(
        min: 1,
        max: 30,
        notInRangeMessage: 'Vos points de statistiques vont de 1 à 30',
    )]
    #[ORM\Column]
    private ?int $statWisdom = 10;

    #[Assert\NotBlank(message: 'Beau ou moche ?')]
    #[Assert\Range(
        min: 1,
        max: 31,
        notInRangeMessage: 'Vos points de statistiques vont de 1 à 30',
    )]
    #[ORM\Column]
    private ?int $statCharisma = 10;

    // On définit une relation ManyToOne avec la classe Alignment
    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Alignment $alignment = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Job $job = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // On définit une relation ManyToMany avec la classe Campaign
    #[ORM\ManyToMany(targetEntity: Campaign::class, mappedBy: 'player')]
    private Collection $campaigns;

    public function __construct()
    {
        $this->campaigns = new ArrayCollection();
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

    public function getCharacterAvatarUrl(): ?string
    {
        return $this->characterAvatarUrl;
    }

    public function setCharacterAvatarUrl(?string $characterAvatarUrl): static
    {
        $this->characterAvatarUrl = $characterAvatarUrl;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getLifepoints(): ?int
    {
        return $this->lifepoints;
    }

    public function setLifepoints(int $lifepoints): static
    {
        $this->lifepoints = $lifepoints;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): static
    {
        $this->background = $background;

        return $this;
    }

    public function getStatStrength(): ?int
    {
        return $this->statStrength;
    }

    public function setStatStrength(int $statStrength): static
    {
        $this->statStrength = $statStrength;

        return $this;
    }

    public function getStatDexterity(): ?int
    {
        return $this->statDexterity;
    }

    public function setStatDexterity(int $statDexterity): static
    {
        $this->statDexterity = $statDexterity;

        return $this;
    }

    public function getStatEndurance(): ?int
    {
        return $this->statEndurance;
    }

    public function setStatEndurance(int $statEndurance): static
    {
        $this->statEndurance = $statEndurance;

        return $this;
    }

    public function getStatIntelligence(): ?int
    {
        return $this->statIntelligence;
    }

    public function setStatIntelligence(int $statIntelligence): static
    {
        $this->statIntelligence = $statIntelligence;

        return $this;
    }

    public function getStatWisdom(): ?int
    {
        return $this->statWisdom;
    }

    public function setStatWisdom(int $statWisdom): static
    {
        $this->statWisdom = $statWisdom;

        return $this;
    }

    public function getStatCharisma(): ?int
    {
        return $this->statCharisma;
    }

    public function setStatCharisma(int $statCharisma): static
    {
        $this->statCharisma = $statCharisma;

        return $this;
    }

    public function getAlignment(): ?Alignment
    {
        return $this->alignment;
    }

    public function setAlignment(?Alignment $alignment): static
    {
        $this->alignment = $alignment;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): static
    {
        $this->job = $job;

        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Campaign>
     */
    public function getCampaigns(): Collection
    {
        return $this->campaigns;
    }

    public function addCampaign(Campaign $campaign): static
    {
        if (!$this->campaigns->contains($campaign)) {
            $this->campaigns->add($campaign);
            $campaign->addPlayer($this);
        }

        return $this;
    }

    public function removeCampaign(Campaign $campaign): static
    {
        if ($this->campaigns->removeElement($campaign)) {
            $campaign->removePlayer($this);
        }

        return $this;
    }
}
