<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\QnaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QnaRepository::class)]
#[ApiResource]
class Qna
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $question = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $answer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\ManyToOne(inversedBy: 'qnas')]
    private ?Admin $senderAdmin = null;

    #[ORM\ManyToOne(inversedBy: 'qnas')]
    private ?SuperAdmin $senderSuperAdmin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): static
    {
        $this->answer = $answer;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): static
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getSenderAdmin(): ?Admin
    {
        return $this->senderAdmin;
    }

    public function setSenderAdmin(?Admin $user): static
    {
        $this->senderAdmin = $user;

        return $this;
    }

    public function getSenderSuperAdmin(): ?SuperAdmin
    {
        return $this->senderSuperAdmin;
    }

    public function setSenderSuperAdmin(?SuperAdmin $user): static
    {
        $this->senderSuperAdmin = $user;

        return $this;
    }
}
