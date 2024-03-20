<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[Vich\Uploadable]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Area $area_id = null;

    #[ORM\Column(name: "image", type: "string", length: 255, nullable: true)]
    protected ?string $image = null;

    #[Vich\UploadableField(mapping: "assets", fileNameProperty: "image")]
    #[ORM\Column]
    protected $imageFile;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getAreaId(): ?Area
    {
        return $this->area_id;
    }

    public function setAreaId(?Area $area_id): static
    {
        $this->area_id = $area_id;

        return $this;
    }
    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImageFile(File $image = null): static
    {
        $this->imageFile = $image;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
