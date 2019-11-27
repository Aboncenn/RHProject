<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CampagneRepository")
 */
class Campagne
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserByCampagne", mappedBy="id_campagne")
     */
    private $campagneByUser;

    public function __construct()
    {
        $this->campagneByUser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection|UserByCampagnes[]
     */
    public function getCampagneByUser()
    {
        return $this->campagneByUser;
    }

    public function addCampagneByUser(UserByCampagne $campagneByUser): self
    {
        if (!$this->campagneByUser->contains($campagneByUser)) {
            $this->campagneByUser[] = $campagneByUser;
            $campagneByUser->setIdUser($this);
        }

        return $this;
    }

    public function removeCampagneByUser(UserByCampagne $campagneByUser): self
    {
        if ($this->campagneByUser->contains($campagneByUser)) {
            $this->campagneByUser->removeElement($campagneByUser);
            // set the owning side to null (unless already changed)
            if ($campagneByUser->getIdUser() === $this) {
                $campagneByUser->setIdUser(null);
            }
        }

        return $this;
    }
}
