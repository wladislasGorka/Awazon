<?php

namespace App\DataFixtures;

use App\Entity\CategoryShop;
use App\Entity\Shop;
use App\Entity\City;
use App\Entity\Merchant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ShopFixtures extends Fixture implements DependentFixtureInterface
{
    public const SHOP_REFERENCE = 'shop-';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $shop = new Shop();
            $shop->setName($faker->company);
            $shop->setLogo($faker->imageUrl(200, 200));
            $shop->setSiret((int) $faker->numberBetween(10000000000000, 99999999999999));
            $shop->setAddress($faker->address);
            $shop->setLongitude($faker->longitude);
            $shop->setLatitude($faker->latitude);
            $shop->setPhone($faker->phoneNumber(9, true));
            $shop->setCreationDate(new \DateTime());
            $shop->setStatus($faker->randomElement(['active', 'inactive']));

            // Gestion du compte PayPal
            if ($faker->boolean(50)) { // 50% de chance d'avoir un compte PayPal
                $shop->setPaypalAccount($faker->email);
                $shop->setPaypalId($faker->uuid);
            } else {
                $shop->setPaypalAccount(null);
                $shop->setPaypalId(null);
            }

            $shop->setType($faker->randomElement([\App\Config\TypeShop::RESTAURANT, \App\Config\TypeShop::MAGASIN]));

            $cityReference = CityFixtures::CITY_REFERENCE . $faker->numberBetween(0, 3);
            if ($this->hasReference($cityReference, City::class)) {
                $shop->setCity($this->getReference($cityReference, City::class));
            }

            $merchantReference = UsersFixtures::MERCHANT_REFERENCE . $faker->numberBetween(0, 2);
            if ($this->hasReference($merchantReference, Merchant::class)) {
                $shop->setMerchantId($this->getReference($merchantReference, Merchant::class));
            } 

            $categoryReference = CategoryShopFixtures::CATEGORYSHOP_REFERENCE . $faker->numberBetween(0, 9);
            if ($this->hasReference($categoryReference, CategoryShop::class)) {
                $shop->addCategory($this->getReference($categoryReference, CategoryShop::class));
            } 

            $manager->persist($shop);

            $this->addReference(self::SHOP_REFERENCE . $i, $shop);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CityFixtures::class,
            UsersFixtures::class,
            CategoryShopFixtures::class
        ];
    }
}