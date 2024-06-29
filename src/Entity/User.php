<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


// Cette classe est utilisé pour définir les utilisateurs du site
 // On définit les propriétés de la classe User
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity('email', message: 'Adresse mail déjà existante')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\Email(message: 'Merci de mettre un email valide')]
    #[Assert\NotBlank(message: 'il est marqué EMAIL alors mets ton EMAIL !!')]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[Assert\Length(
        min: 1,
        max: 50,
        minMessage: 'Pseudo trop court, minimum attendu 1 caractère.',
        maxMessage: 'Pseudo trop long, maximum 50 caractères.',
    )]
    #[Assert\NotBlank(message: 'Merci de mettre un pseudo')]
    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $userAvatarUrl = null;


    // On définit une relation OneToMany avec la classe Character
    #[ORM\OneToMany(targetEntity: Character::class, mappedBy: 'user')]
    private Collection $characters;

    #[ORM\ManyToMany(targetEntity: Campaign::class, mappedBy: 'gameMaster')]
    private Collection $gamemaster;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->gamemaster = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return $this->roles;
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getUserAvatarUrl(): ?string
    {
        return $this->userAvatarUrl;
    }

    public function setUserAvatarUrl(?string $userAvatarUrl): static
    {
        $this->userAvatarUrl = $userAvatarUrl;

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
            $character->setUser($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getUser() === $this) {
                $character->setUser(null);
            }
        }

        return $this;
    }

    //     return $this;
    // }

    /**
     * @return Collection<int, Campaign>
     */
    public function getGamemaster(): Collection
    {
        return $this->gamemaster;
    }

    public function addGamemaster(Campaign $gamemaster): static
    {
        if (!$this->gamemaster->contains($gamemaster)) {
            $this->gamemaster->add($gamemaster);
            $gamemaster->addGameMaster($this);
        }

        return $this;
    }

    public function removeGamemaster(Campaign $gamemaster): static
    {
        if ($this->gamemaster->removeElement($gamemaster)) {
            $gamemaster->removeGameMaster($this);
        }

        return $this;
    }
}
