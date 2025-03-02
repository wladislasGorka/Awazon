<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CityFixtures extends Fixture
{
    public const CITY_REFERENCE = 'city-';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $city = new City();
            $city->setCityName($faker->city);
            $city->setCode((int)$faker->postcode); // Ou $faker->postcode si code est une string

            $manager->persist($city);

            $referenceName = self::CITY_REFERENCE . $i;
            $this->addReference($referenceName, $city);

            dump($referenceName); // Vérifier le nom de la référence
            dump($city); // Vérifier l'objet City créé
        }

        $manager->flush();
    }
}