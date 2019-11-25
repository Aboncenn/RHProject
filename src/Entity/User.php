<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRH;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserByCampagne", mappedBy="id_user", orphanRemoval=true)
     */
    private $userByCampagnes;

    public function __construct()
    {
        $this->userByCampagnes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getIsRH(): ?bool
    {
        return $this->isRH;
    }

    public function setIsRH(bool $isRH): self
    {
        $this->isRH = $isRH;

        return $this;
    }

    /**
     * @return Collection|UserByCampagne[]
     */
    public function getUserByCampagnes(): Collection
    {
        return $this->userByCampagnes;
    }

    public function addUserByCampagne(UserByCampagne $userByCampagne): self
    {
        if (!$this->userByCampagnes->contains($userByCampagne)) {
            $this->userByCampagnes[] = $userByCampagne;
            $userByCampagne->setIdUser($this);
        }

        return $this;
    }

    public function removeUserByCampagne(UserByCampagne $userByCampagne): self
    {
        if ($this->userByCampagnes->contains($userByCampagne)) {
            $this->userByCampagnes->removeElement($userByCampagne);
            // set the owning side to null (unless already changed)
            if ($userByCampagne->getIdUser() === $this) {
                $userByCampagne->setIdUser(null);
            }
        }

        return $this;
    }
}
