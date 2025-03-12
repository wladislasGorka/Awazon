<?php

namespace App\DataFixtures;

use App\Entity\Keyword;
use App\Entity\Product;
use App\Entity\Shop;
use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class KeywordFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupérer un Shop existant
        $shopRepository = $manager->getRepository(Shop::class);
        $shops = $shopRepository->findAll();

        // Récupérer une SubCategory existante
        $subCategoryRepository = $manager->getRepository(SubCategory::class);
        $subCategories = $subCategoryRepository->findAll();

        if (empty($shops)) {
            throw new \Exception("Aucun Shop trouvé. Assurez-vous d'exécuter ShopFixtures en premier.");
        }

        if (empty($subCategories)) {
            throw new \Exception("Aucune SubCategory trouvée. Assurez-vous d'exécuter SubCategoryFixtures en premier.");
        }

        $shop = $shops[array_rand($shops)];
        $subCategory = $subCategories[array_rand($subCategories)];

        $product = new Product();
        $product->setName($faker->company());
        $product->setPrice($faker->randomFloat(2, 10, 1000));
        $product->setShop($shop);
        $product->setSubCategory($subCategory); // Associer la SubCategory au Product
        $manager->persist($product);

        // Génération de 10 Keywords aléatoires
        for ($i = 0; $i < 10; $i++) {
            $keyword = new Keyword();
            $keyword->setName($faker->word())
                ->setProduct($product);
            $manager->persist($keyword);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ShopFixtures::class,
            SubCategoryFixtures::class,
        ];
    }
}