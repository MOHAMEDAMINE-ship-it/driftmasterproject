<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CircuitRepository::class)
 */
class Circuit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateouverture;

    /**
     * @ORM\Column(type="integer")
     */
    private $longeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proprieteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombrevirage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getDateouverture(): ?\DateTimeInterface
    {
        return $this->dateouverture;
    }

    public function setDateouverture(?\DateTimeInterface $dateouverture): self
    {
        $this->dateouverture = $dateouverture;

        return $this;
    }

    public function getLongeur(): ?int
    {
        return $this->longeur;
    }

    public function setLongeur(int $longeur): self
    {
        $this->longeur = $longeur;

        return $this;
    }

    public function getProprieteur(): ?string
    {
        return $this->proprieteur;
    }

    public function setProprieteur(string $proprieteur): self
    {
        $this->proprieteur = $proprieteur;

        return $this;
    }

    public function getNombrevirage(): ?int
    {
        return $this->nombrevirage;
    }

    public function setNombrevirage(int $nombrevirage): self
    {
        $this->nombrevirage = $nombrevirage;

        return $this;
    }

   
  
}
