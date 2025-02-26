<?php

namespace App\Entity;

use App\Repository\SuperAdminRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperAdminRepository::class)]
class SuperAdmin extends Users
{
    
}