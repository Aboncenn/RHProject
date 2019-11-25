<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatRepository")
 */
class Stat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_User;

    /**
     * @ORM\Column(type="float")
     */
    private $Communication;

    /**
     * @ORM\Column(type="float")
     */
    private $CriticalThinking;

    /**
     * @ORM\Column(type="float")
     */
    private $Leadership;

    /**
     * @ORM\Column(type="float")
     */
    private $PositiveAttitude;

    /**
     * @ORM\Column(type="float")
     */
    private $TeamWork;

    /**
     * @ORM\Column(type="float")
     */
    private $WorkEthic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->id_User;
    }

    public function setIdUser(User $id_User): self
    {
        $this->id_User = $id_User;

        return $this;
    }

    public function getCommunication(): ?float
    {
        return $this->Communication;
    }

    public function setCommunication(float $Communication): self
    {
        $this->Communication = $Communication;

        return $this;
    }

    public function getCriticalThinking(): ?float
    {
        return $this->CriticalThinking;
    }

    public function setCriticalThinking(float $CriticalThinking): self
    {
        $this->CriticalThinking = $CriticalThinking;

        return $this;
    }

    public function getLeadership(): ?float
    {
        return $this->Leadership;
    }

    public function setLeadership(float $Leadership): self
    {
        $this->Leadership = $Leadership;

        return $this;
    }

    public function getPositiveAttitude(): ?float
    {
        return $this->PositiveAttitude;
    }

    public function setPositiveAttitude(float $PositiveAttitude): self
    {
        $this->PositiveAttitude = $PositiveAttitude;

        return $this;
    }

    public function getTeamWork(): ?float
    {
        return $this->TeamWork;
    }

    public function setTeamWork(float $TeamWork): self
    {
        $this->TeamWork = $TeamWork;

        return $this;
    }

    public function getWorkEthic(): ?float
    {
        return $this->WorkEthic;
    }

    public function setWorkEthic(float $WorkEthic): self
    {
        $this->WorkEthic = $WorkEthic;

        return $this;
    }
}
