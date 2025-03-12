<?php

namespace App\DataFixtures;

use App\Entity\ForumSection;
use App\Config\ForumSectionAccess;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ForumSectionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 20; $i++) {
            $forumSection = new ForumSection();
            $forumSection->setName($faker->sentence);
            $forumSection->setAccess($faker->randomElement([ForumSectionAccess::Member, ForumSectionAccess::Merchant]));

            // Ajoute d'autres propriétés et relations si nécessaire

            $manager->persist($forumSection);
        }

        $manager->flush();
    }
}
