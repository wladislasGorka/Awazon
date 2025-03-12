<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCE = 'category-';

    public function load(ObjectManager $manager): void
    {
        // Exemples de catégories de produits
        $categories = [
            'Vêtements',
            'Électronique',
            'Maison et décoration',
            'Beauté et santé',
            'Sports et loisirs'
        ];

        foreach ($categories as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);

            // Add a reference to use later
            $this->addReference(self::CATEGORY_REFERENCE . $key, $category);
        }

        $manager->flush();
    }
}
