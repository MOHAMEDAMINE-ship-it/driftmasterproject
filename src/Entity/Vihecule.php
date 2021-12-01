<?php

namespace App\Entity;

use App\Repository\ViheculeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ViheculeRepository::class)
 */
class Vihecule
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Puissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $consommation;

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

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPuissance(): ?string
    {
        return $this->Puissance;
    }

    public function setPuissance(string $Puissance): self
    {
        $this->Puissance = $Puissance;

        return $this;
    }

    public function getConsommation(): ?string
    {
        return $this->consommation;
    }

    public function setConsommation(string $consommation): self
    {
        $this->consommation = $consommation;

        return $this;
    }
}
