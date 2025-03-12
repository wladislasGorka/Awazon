<?php

namespace App\DataFixtures;

use App\Entity\FicheShop;
use App\Config\FicheShopStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FicheShopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $ficheShop = new FicheShop();
            $ficheShop->setName($faker->company);
            $ficheShop->setDescription($faker->paragraph);
            $ficheShop->setStatus(FicheShopStatus::Valide); // ou une autre valeur si nécessaire

            // Ajoute d'autres propriétés et relations si nécessaire

            $manager->persist($ficheShop);
        }

        $manager->flush();
    }
}
