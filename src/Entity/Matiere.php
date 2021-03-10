<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
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
     * @ORM\Column(type="dateinterval")
     */
    private $dateStartToEnd;

    /**
     * @ORM\OneToOne(targetEntity=Intervenant::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $intervenant;

    /**
     * @ORM\OneToOne(targetEntity=Classe::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $promotion;

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

    public function getDateStartToEnd(): ?\DateInterval
    {
        return $this->dateStartToEnd;
    }

    public function setDateStartToEnd(\DateInterval $dateStartToEnd): self
    {
        $this->dateStartToEnd = $dateStartToEnd;

        return $this;
    }

    public function getIntervenant(): ?Intervenant
    {
        return $this->intervenant;
    }

    public function setIntervenant(Intervenant $intervenant): self
    {
        $this->intervenant = $intervenant;

        return $this;
    }

    public function getPromotion(): ?Classe
    {
        return $this->promotion;
    }

    public function setPromotion(Classe $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }
}
