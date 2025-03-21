<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\SubCategory;
use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private const NAME = 'name';
    private const DESCRIPTION = 'description';
    private const PRICE = 'price';
    private const STOCK = 'stock';
    private const SUBCATEGORY_REFERENCE_KEY = 'subCategoryReferenceKey';
    private const SHOP_REFERENCE_KEY = 'shopReferenceKey';
    public const PRODUCT_REFERENCE = 'product-'; // Ajout de la constante pour les références

    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'name' => 'T-shirt en coton',
                'description' => 'T-shirt confortable en coton.',
                'price' => 19.99,
                'stock' => 'En stock',
                'subCategoryReferenceKey' => 0,
                'shopReferenceKey' => 0,
            ],
            [
                'name' => 'Jeans slim',
                'description' => 'Jeans slim fit pour un look moderne.',
                'price' => 49.99,
                'stock' => 'En stock',
                'subCategoryReferenceKey' => 1,
                'shopReferenceKey' => 1,
            ],
            [
                'name' => 'iPhone 13',
                'description' => 'Smartphone avec écran Retina.',
                'price' => 999.99,
                'stock' => 'Disponible',
                'subCategoryReferenceKey' => 2,
                'shopReferenceKey' => 2,
            ],
            [
                'name' => 'Ordinateur portable',
                'description' => 'Ordinateur portable puissant et léger.',
                'price' => 899.99,
                'stock' => 'En stock',
                'subCategoryReferenceKey' => 3,
                'shopReferenceKey' => 3,
            ],
            [
                'name' => 'Jupe Longue',
                'description' => 'Jupe longue à motif mexicain.',
                'price' => 50.99,
                'stock' => 'En stock',
                'subCategoryReferenceKey' => 4,
                'shopReferenceKey' => 4,
            ],
        ];
        $i = 0; // Ajout du compteur

        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData[self::NAME]);
            $product->setDescription($productData[self::DESCRIPTION]);
            $product->setPrice($productData[self::PRICE]);
            $product->setStock($productData[self::STOCK]);

            $subCategoryReference = SubCategoryFixtures::SUBCATEGORY_REFERENCE . $productData[self::SUBCATEGORY_REFERENCE_KEY];
            if ($this->hasReference($subCategoryReference, SubCategory::class)) {
                $product->setSubCategory($this->getReference($subCategoryReference, SubCategory::class));
            } else {
                error_log("SubCategory reference not found: " . $subCategoryReference);
            }

            $shopReference = ShopFixtures::SHOP_REFERENCE . $productData[self::SHOP_REFERENCE_KEY];
            if ($this->hasReference($shopReference, Shop::class)) {
                $product->setShopId($this->getReference($shopReference, Shop::class));
            } else {
                error_log("Shop reference not found: " . $shopReference);
            }

            $manager->persist($product);
            $this->addReference(self::PRODUCT_REFERENCE . $i, $product);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SubCategoryFixtures::class,
            ShopFixtures::class,
        ];
    }
}