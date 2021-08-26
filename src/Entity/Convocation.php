<?php

namespace App\Entity;

use App\Repository\ConvocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConvocationRepository::class)
 */
class Convocation
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
    private $nomConvocation;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $dateConvocation;

    /**
     * @ORM\OneToMany(targetEntity=Enseignant::class, mappedBy="convocation")
     */
    private $enseignant;

    public function __construct()
    {
        $this->enseignant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomConvocation(): ?string
    {
        return $this->nomConvocation;
    }

    public function setNomConvocation(string $nomConvocation): self
    {
        $this->nomConvocation = $nomConvocation;

        return $this;
    }

    public function getDateConvocation(): ?string
    {
        return $this->dateConvocation;
    }

    public function setDateConvocation(string $dateConvocation): self
    {
        $this->dateConvocation = $dateConvocation;

        return $this;
    }

    /**
     * @return Collection|Enseignant[]
     */
    public function getEnseignant(): Collection
    {
        return $this->enseignant;
    }

    public function addEnseignant(Enseignant $enseignant): self
    {
        if (!$this->enseignant->contains($enseignant)) {
            $this->enseignant[] = $enseignant;
            $enseignant->setConvocation($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): self
    {
        if ($this->enseignant->removeElement($enseignant)) {
            // set the owning side to null (unless already changed)
            if ($enseignant->getConvocation() === $this) {
                $enseignant->setConvocation(null);
            }
        }

        return $this;
    }
}
