<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LevelFixtures extends Fixture
{
    public const LEVEL_REFERENCE = 'level-'; // Définir la constante ici

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Générer 5 niveaux fictifs
        for ($i = 0; $i < 5; $i++) {
            $level = new Level();
            $level->setTitle($faker->word()); // aléatoire voir si un enum c'est pas mieux
            $manager->persist($level);

            $this->addReference(self::LEVEL_REFERENCE . $i, $level); // Utiliser la constante définie
        }

        $manager->flush();
    }
}