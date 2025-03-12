<?php

namespace App\DataFixtures;

use App\Entity\InfoFicheShop;
use App\Entity\FicheShop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InfoFicheShopFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        
        $ficheShop = new FicheShop();
        $ficheShop->setName($faker->company());
        $manager->persist($ficheShop);

       
        for ($i = 0; $i < 10; $i++) {
            $info = new InfoFicheShop();
            $info->setName($faker->word()) 
                ->setValue($faker->sentence())
                ->setIcon($faker->randomElement(['clock', 'phone', 'web', 'map', 'email'])) 
                ->setFicheShop($ficheShop);
            $manager->persist($info);
        }

        // Sauvegardez toutes les données
        $manager->flush();
    }
}
