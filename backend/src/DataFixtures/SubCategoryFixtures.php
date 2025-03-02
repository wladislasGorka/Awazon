<?php

namespace App\DataFixtures;


use App\Entity\SubCategory;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SubCategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public const SUBCATEGORY_REFERENCE = 'subcategory-';

    public function load(ObjectManager $manager): void
    {
        // Exemples de sous-catégories de produits
        $subCategories = [
            [
                'name' => 'T-shirts',
                'categoryReferenceKey' => 0, // Vêtements
            ],
            [
                'name' => 'Jeans',
                'categoryReferenceKey' => 0, // Vêtements
            ],
            [
                'name' => 'Smartphones',
                'categoryReferenceKey' => 1, // Électronique
            ],
            [
                'name' => 'Ordinateurs portables',
                'categoryReferenceKey' => 1, // Électronique
            ],
            [
                'name' => 'Lampes',
                'categoryReferenceKey' => 2, // Maison et décoration
            ],
            [
                'name' => 'Coussins',
                'categoryReferenceKey' => 2, // Maison et décoration
            ],
            [
                'name' => 'Soins du visage',
                'categoryReferenceKey' => 3, // Beauté et santé
            ],
            [
                'name' => 'Compléments alimentaires',
                'categoryReferenceKey' => 3, // Beauté et santé
            ],
            [
                'name' => 'Vélos',
                'categoryReferenceKey' => 4, // Sports et loisirs
            ],
            [
                'name' => 'Tentes',
                'categoryReferenceKey' => 4, // Sports et loisirs
            ],
        ];

        foreach ($subCategories as $key => $subCategoryData) {
            $subCategory = new SubCategory();
            $subCategory->setName($subCategoryData['name']);
            $subCategory->setCategory($this->getReference(
                CategoryFixtures::CATEGORY_REFERENCE . $subCategoryData['categoryReferenceKey'],
                Category::class
            ));
            $manager->persist($subCategory);

            // Add a reference to use later
            $this->addReference(self::SUBCATEGORY_REFERENCE . $key, $subCategory);
        }

        $manager->flush();
    }

    public function getDependencies():array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}