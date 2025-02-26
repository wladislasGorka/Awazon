<?php

namespace App\Entity;

use App\Config\ForumSectionAccess;
use App\Repository\ForumSectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumSectionRepository::class)]
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

    /**
     * @var Collection<int, ForumSubject>
     */
    #[ORM\OneToMany(targetEntity: ForumSubject::class, mappedBy: 'forumSection')]
    private Collection $subjects;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ForumSubject>
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(ForumSubject $subject): static
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects->add($subject);
            $subject->setForumSection($this);
        }

        return $this;
    }

    public function removeSubject(ForumSubject $subject): static
    {
        if ($this->subjects->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getForumSection() === $this) {
                $subject->setForumSection(null);
            }
        }

        return $this;
    }
}
