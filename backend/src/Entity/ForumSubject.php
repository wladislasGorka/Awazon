<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ForumSubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForumSubjectRepository::class)]
#[ApiResource()]
class ForumSubject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'subjects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ForumSection $forumSection = null;

    /**
     * @var Collection<int, ForumMessage>
     */
    #[ORM\OneToMany(targetEntity: ForumMessage::class, mappedBy: 'forumSubject')]
    private Collection $messages;

    #[ORM\ManyToOne(inversedBy: 'forumSubjects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
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

    public function getForumSection(): ?ForumSection
    {
        return $this->forumSection;
    }

    public function setForumSection(?ForumSection $forumSection): static
    {
        $this->forumSection = $forumSection;

        return $this;
    }

    /**
     * @return Collection<int, ForumMessage>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(ForumMessage $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setForumSubject($this);
        }

        return $this;
    }

    public function removeMessage(ForumMessage $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getForumSubject() === $this) {
                $message->setForumSubject(null);
            }
        }

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }
}
