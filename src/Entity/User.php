<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Area::class, mappedBy: 'author')]
    private Collection $area_id;

    public function __construct()
    {
        $this->area_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Area>
     */
    public function getAreaId(): Collection
    {
        return $this->area_id;
    }

    public function addAreaId(Area $areaId): static
    {
        if (!$this->area_id->contains($areaId)) {
            $this->area_id->add($areaId);
            $areaId->setAuthor($this);
        }

        return $this;
    }

    public function removeAreaId(Area $areaId): static
    {
        if ($this->area_id->removeElement($areaId)) {
            // set the owning side to null (unless already changed)
            if ($areaId->getAuthor() === $this) {
                $areaId->setAuthor(null);
            }
        }

        return $this;
    }
}
