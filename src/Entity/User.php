<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $LinkLinkedin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserByCampagne", mappedBy="id_user")
     */
    private $userByCampagnes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user")
     */
    private $text;

    public function __construct()
    {
        $this->text = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getLinkLinkedin(): ?string
    {
        return $this->LinkLinkedin;
    }

    public function setLinkLinkedin(?string $LinkLinkedin): self
    {
        $this->LinkLinkedin = $LinkLinkedin;

        return $this;
    }


        /**
         * @return Collection|UserByCampagnes[]
         */
        public function getUserByCampagnes(): Collection
        {
            return $this->userByCampagnes;
        }

        public function AddUserByCampagnes(UserByCampagne $userByCampagnes): self
        {
            if (!$this->userByCampagnes->contains($userByCampagnes)) {
                $this->userByCampagnes[] = $userByCampagnes;
                $userByCampagnes->setIdUser($this);
            }

            return $this;
        }

        public function removeUserByCampagnes(UserByCampagne $userByCampagnes): self
        {
            if ($this->userByCampagnes->contains($userByCampagnes)) {
                $this->userByCampagnes->removeElement($userByCampagnes);
                // set the owning side to null (unless already changed)
                if ($userByCampagnes->getIdUser() === $this) {
                    $userByCampagnes->setIdUser(null);
                }
            }

            return $this;
        }

        /**
         * @return Collection|Message[]
         */
        public function getText(): Collection
        {
            return $this->text;
        }

        public function addText(Message $text): self
        {
            if (!$this->text->contains($text)) {
                $this->text[] = $text;
                $text->setUser($this);
            }

            return $this;
        }

        public function removeText(Message $text): self
        {
            if ($this->text->contains($text)) {
                $this->text->removeElement($text);
                // set the owning side to null (unless already changed)
                if ($text->getUser() === $this) {
                    $text->setUser(null);
                }
            }

            return $this;
        }

}
