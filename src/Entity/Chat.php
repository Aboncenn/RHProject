<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChatRepository")
 */
class Chat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserByCampagne", inversedBy="chats")
     */
    private $id_CampagnebyUser;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="idchat")
     */
    private $messages;

    public function __construct()
    {
        $this->id_CampagnebyUser = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|UserByCampagne[]
     */
    public function getIdCampagnebyUser(): Collection
    {
        return $this->id_CampagnebyUser;
    }

    public function addIdCampagnebyUser(UserByCampagne $idCampagnebyUser): self
    {
        if (!$this->id_CampagnebyUser->contains($idCampagnebyUser)) {
            $this->id_CampagnebyUser[] = $idCampagnebyUser;
        }

        return $this;
    }

    public function removeIdCampagnebyUser(UserByCampagne $idCampagnebyUser): self
    {
        if ($this->id_CampagnebyUser->contains($idCampagnebyUser)) {
            $this->id_CampagnebyUser->removeElement($idCampagnebyUser);
        }

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setIdchat($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getIdchat() === $this) {
                $message->setIdchat(null);
            }
        }

        return $this;
    }
}
