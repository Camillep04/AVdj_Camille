<?php

namespace App\Entity;

use App\Repository\MotClesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotClesRepository::class)]
class MotCles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_cles = null;

    #[ORM\ManyToMany(targetEntity: MarquePage::class, inversedBy: 'motCles')]
    private Collection $lien;

    public function __construct()
    {
        $this->lien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMotCles(): ?string
    {
        return $this->mot_cles;
    }

    public function setMotCles(string $mot_cles): static
    {
        $this->mot_cles = $mot_cles;

        return $this;
    }

    /**
     * @return Collection<int, MarquePage>
     */
    public function getLien(): Collection
    {
        return $this->lien;
    }

    public function addLien(MarquePage $lien): static
    {
        if (!$this->lien->contains($lien)) {
            $this->lien->add($lien);
        }

        return $this;
    }

    public function removeLien(MarquePage $lien): static
    {
        $this->lien->removeElement($lien);

        return $this;
    }
}
