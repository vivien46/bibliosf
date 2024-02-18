<?php

namespace App\Entity;

use App\Repository\EmpruntsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmpruntsRepository::class)]
class Emprunts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateEmprunt = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateRetour = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Livres $livres = null;

    #[ORM\ManyToOne(inversedBy: 'emprunts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Abonnes $abonnes = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateEmprunt(): ?\DateTimeImmutable
    {
        return $this->dateEmprunt;
    }

    public function setDateEmprunt(\DateTimeImmutable $dateEmprunt): static
    {
        $this->dateEmprunt = $dateEmprunt;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeImmutable
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeImmutable $dateRetour): static
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getLivres(): ?Livres
    {
        return $this->livres;
    }

    public function setLivres(?Livres $livres): static
    {
        $this->livres = $livres;

        return $this;
    }

    public function getAbonnes(): ?Abonnes
    {
        return $this->abonnes;
    }

    public function setAbonnes(?Abonnes $abonnes): static
    {
        $this->abonnes = $abonnes;

        return $this;
    }
}
