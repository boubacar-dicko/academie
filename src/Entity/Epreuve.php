<?php

namespace App\Entity;

use App\Repository\EpreuveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EpreuveRepository::class)
 */
class Epreuve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomEpreuve;

    /**
     * @ORM\Column(type="integer")
     */
    private $coefficient;

    /**
     * @ORM\ManyToOne(targetEntity=Examen::class, inversedBy="epreuves")
     */
    private $examen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEpreuve(): ?string
    {
        return $this->nomEpreuve;
    }

    public function setNomEpreuve(string $nomEpreuve): self
    {
        $this->nomEpreuve = $nomEpreuve;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getExamen(): ?Examen
    {
        return $this->examen;
    }

    public function setExamen(?Examen $examen): self
    {
        $this->examen = $examen;

        return $this;
    }
}
