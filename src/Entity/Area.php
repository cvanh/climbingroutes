<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: AreaRepository::class)]
#[Vich\Uploadable]
class Area
{
    #[ORM\Column(length: 255)]
    public ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $rock_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $location = null;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column]
    protected ?int $parent_id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'areas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;


    #[ORM\Column(name: "image", type: "string", length: 255, nullable: true)]
    protected $image = null;

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

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id): static
    {
        $this->parent_id = $parent_id;

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

    public function getRockType(): ?string
    {
        return $this->rock_type;
    }

    public function setRockType(?string $rock_type): static
    {
        $this->rock_type = $rock_type;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

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

    public function setImageFile(UploadedFile $image = null): static
    {
        $this->imageFile = $image;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}