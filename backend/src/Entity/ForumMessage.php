<?php

namespace App\Entity;
use App\Config\ForumMessageStatus;
use App\Repository\ForumMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ForumMessageRepository::class)]
class ForumMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_edit = null;

    #[ORM\Column(enumType: ForumMessageStatus::class)]
    private ?ForumMessageStatus $message_status = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ForumSubject $forumSubject = null;

    #[ORM\ManyToOne(inversedBy: 'forumMessages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateEdit(): ?\DateTimeInterface
    {
        return $this->date_edit;
    }

    public function setDateEdit(\DateTimeInterface $date_edit): static
    {
        $this->date_edit = $date_edit;

        return $this;
    }

    public function getMessageStatus(): ?ForumMessageStatus
    {
        return $this->message_status;
    }

    public function setMessageStatus(ForumMessageStatus $message_status): static
    {
        $this->message_status = $message_status;

        return $this;
    }

    public function getForumSubject(): ?ForumSubject
    {
        return $this->forumSubject;
    }

    public function setForumSubject(?ForumSubject $forumSubject): static
    {
        $this->forumSubject = $forumSubject;

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
