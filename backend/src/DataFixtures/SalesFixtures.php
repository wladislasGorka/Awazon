<?php

namespace App\DataFixtures;

use App\Entity\Sales;
use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SalesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupère les shops existants
        $shopRepository = $manager->getRepository(Shop::class);

        for ($i = 0; $i < 10; $i++) {
            $sales = new Sales();
            $sales->setSlogan($faker->catchPhrase);
            $sales->setDescription($faker->text);
            $sales->setPourcent($faker->randomFloat(2, 0, 100) . '%');
            $sales->setDateStart($faker->dateTimeBetween('-1 year', 'now'));
            $sales->setDateEnd($faker->dateTimeBetween('now', '+1 year'));

            // Associe un shop existant
            $shop = $shopRepository->findOneBy([], ['id' => 'ASC']);
            
            if ($shop) {
                $sales->setShop($shop);
            } else {
                throw new \Exception('No shop found to associate with Sales');
            }

            $manager->persist($sales);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ShopFixtures::class, 
        ];
    }
}
