<?php

namespace App\DataFixtures;

use App\Entity\GiftCode;
use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class GiftcodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupère les shops existants
        $shopRepository = $manager->getRepository(Shop::class);
        $shops = $shopRepository->findAll();
        
        for ($i = 0; $i < 20; $i++) {
            $giftCode = new GiftCode();
            $giftCode->setCode($faker->bothify('????-#####'));
            $giftCode->setDiscount($faker->numberBetween(5, 50));
            $giftCode->setCreationDate($faker->dateTimeThisYear);
            $giftCode->setExpirationDate($faker->dateTimeThisYear('+1 year'));

            // Associe un shop aléatoire
            if (!empty($shops)) {
                $shop = $shops[array_rand($shops)];
                $giftCode->setShopId($shop);
            }

            $manager->persist($giftCode);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            
            ShopFixtures::class, 
            ProductFixtures::class,
        ];
    }
}
