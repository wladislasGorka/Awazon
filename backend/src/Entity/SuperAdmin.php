<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SuperAdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperAdminRepository::class)]
#[ApiResource()]
class SuperAdmin extends Users
{
    /**
     * @var Collection<int, Qna>
     */
    #[ORM\OneToMany(targetEntity: Qna::class, mappedBy: 'senderSuperAdmin')]
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
            $qna->setsenderSuperAdmin($this);
        }

        return $this;
    }

    public function removeQna(Qna $qna): static
    {
        if ($this->qnas->removeElement($qna)) {
            // set the owning side to null (unless already changed)
            if ($qna->getsenderSuperAdmin() === $this) {
                $qna->setsenderSuperAdmin(null);
            }
        }

        return $this;
    }
}