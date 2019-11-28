<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserByCampagneRepository")
 */
class UserByCampagne
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campagne", inversedBy="campagneByUser")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_campagne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userByCampagnes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Chat", mappedBy="id_CampagnebyUser")
     */
    private $chats;

    /**
     * @ORM\Column(type="boolean")
     */
    private $finished = False;

    public function __construct()
    {
        $this->chats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCampagne(): ?Campagne
    {
        return $this->id_campagne;
    }

    public function setIdCampagne(?Campagne $id_campagne): self
    {
        $this->id_campagne = $id_campagne;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return Collection|Chat[]
     */
    public function getChats(): Collection
    {
        return $this->chats;
    }

    public function addChat(Chat $chat): self
    {
        if (!$this->chats->contains($chat)) {
            $this->chats[] = $chat;
            $chat->addIdCampagnebyUser($this);
        }

        return $this;
    }

    public function removeChat(Chat $chat): self
    {
        if ($this->chats->contains($chat)) {
            $this->chats->removeElement($chat);
            $chat->removeIdCampagnebyUser($this);
        }

        return $this;
    }

    public function getFinished(): ?bool
    {
        return $this->finished;
    }

    public function setFinished(bool $finished): self
    {
        $this->finished = $finished;

        return $this;
    }
}
