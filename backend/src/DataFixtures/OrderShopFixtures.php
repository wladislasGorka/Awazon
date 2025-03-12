<?php

namespace App\DataFixtures;

use App\Entity\OrderShop;
use App\Entity\Shop;
use App\Entity\Order;
use App\Config\OrderShopStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class OrderShopFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Création de relations OrderShop
        for ($i = 0; $i < 10; $i++) {
            $orderShop = new OrderShop();

            // Définir un statut aléatoire
            $orderShop->setStatus($faker->randomElement(OrderShopStatus::cases()));

            // Récupérer une commande aléatoire
            $orderReference = 'order-' . $faker->numberBetween(0, 9); 
            $order = $this->getReference($orderReference, order::class);
            $orderShop->setOrderId($order);

            // Récupérer une boutique aléatoire
            $shopReference = 'shop-' . $faker->numberBetween(0, 4); 
            $shop = $this->getReference($shopReference, shop::class);
            $orderShop->setShop($shop);

            $manager->persist($orderShop);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class, 
            ShopFixtures::class,  
        ];
    }
}
