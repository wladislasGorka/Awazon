<?php

namespace App\DataFixtures;

use App\Entity\CategoryShop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryShopFixtures extends Fixture
{
    public const CATEGORYSHOP_REFERENCE = 'categoryShop-';

    public function load(ObjectManager $manager): void
    {
        // Exemples de CategoryShop
        $categories = [
          'Pharmacie',
          'Glacier',
          'Garage',
          'Restaurant',
          'Salon de coiffure',
          'Librairie',
          'Boulangerie',
          'Boutique de vêtements',
          'Magasin de meubles',
          'Épicerie'
        ];

        foreach ($categories as $i=>$categoryName) {
            $category = new CategoryShop();
            $category->setName($categoryName);
            $manager->persist($category);

            $referenceName = self::CATEGORYSHOP_REFERENCE . $i;
            $this->addReference($referenceName, $category);
        }


        $manager->flush();
    }
}
