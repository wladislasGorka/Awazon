<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ApiResource()]
#[ORM\Table(name: '`admin`')]
class Admin extends Users
{
    
    /**
     * @var Collection<int, Qna>
     */
    #[ORM\OneToMany(targetEntity: Qna::class, mappedBy: 'senderAdmin')]
    private Collection $qnas;

    public function __construct()
    {
        $this->qnas = new ArrayCollection();
    }

    /**
     * @return Collection<int, Qna>
     */
    public function getQnas(): Collection
    {
        return $this->qnas;
    }

    public function addQna(Qna $qna): static
    {
        if (!$this->qnas->contains($qna)) {
            $this->qnas->add($qna);
            $qna->setsenderAdmin($this);
        }

        return $this;
    }

    public function removeQna(Qna $qna): static
    {
        if ($this->qnas->removeElement($qna)) {
            // set the owning side to null (unless already changed)
            if ($qna->getsenderAdmin() === $this) {
                $qna->setsenderAdmin(null);
            }
        }

        return $this;
    }
}