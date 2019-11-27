<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="text")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chat", inversedBy="messages")
     */
    private $idchat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIdchat(): ?Chat
    {
        return $this->idchat;
    }

    public function setIdchat(?Chat $idchat): self
    {
        $this->idchat = $idchat;

        return $this;
    }
}
