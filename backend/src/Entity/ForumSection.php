<?php

namespace App\Entity;

use App\Config\ForumSectionAccess;
use App\Repository\ForumSectionRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ForumSectionRepository::class)]
#[ApiResource]
class ForumSection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(enumType: ForumSectionAccess::class)]
    private ?ForumSectionAccess $access = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAccess(): ?ForumSectionAccess
    {
        return $this->access;
    }

    public function setAccess(ForumSectionAccess $access): static
    {
        $this->access = $access;

        return $this;
    }
}
