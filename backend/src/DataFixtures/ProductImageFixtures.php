<?php

namespace App\DataFixtures;

use App\Entity\ProductImage;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProductImageFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_REFERENCE = 'product-';

    public function load(ObjectManager $manager): void
    {
        // Associer des images à des produits existants via des références
        for ($i = 0; $i < 10; $i++) {
            $productImage = new ProductImage();
            $productImage->setName('image_' . $i . '.jpg'); // Nom de l'image, ici image_X.jpg

            // Récupérer un produit existant via sa référence
            $productReference = self::PRODUCT_REFERENCE . ($i % 5); // 5 produits référencés dans ProductFixtures
            $product = $this->getReference($productReference, product::class);
            $productImage->setProduct($product);

            $manager->persist($productImage);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class, // Assurez-vous que les produits existent dans ProductFixtures
        ];
    }
}
