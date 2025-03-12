<?php

namespace App\DataFixtures;

use App\Entity\ImageShop;
use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageShopFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Récupère les shops existants
        $shopRepository = $manager->getRepository(Shop::class);
        $shops = $shopRepository->findAll();

        // Crée des chemins d'images manuellement
        $imagePaths = [
            'images/testShop.jpg',
            'images/imageShop2.jpg',
            'images/imageShop3.jpg',
            'images/imageShop4.jpg',
        ];

        foreach ($imagePaths as $path) {
            $imageShop = new ImageShop();
            $imageShop->setPath($path);

            // Associe un shop aléatoire
            if (!empty($shops)) {
                $shop = $shops[array_rand($shops)];
                $imageShop->setShop($shop);
            }

            $manager->persist($imageShop);
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