<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Event;
use App\Entity\Shop;
use App\Entity\City;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $shops = $manager->getRepository(Shop::class)->findAll();
        $cities = $manager->getRepository(City::class)->findAll();

        for ($i = 0; $i < 20; $i++) {
            $event = new Event();
            $event->setTitle($faker->sentence);
            $event->setDescription($faker->text);
            $event->setAddress($faker->address);

            $startDate = $faker->dateTimeBetween('now', '+1 month');
            $endDate = $faker->dateTimeBetween($startDate, '+2 months');

            $event->setDateStart($startDate);
            $event->setDateEnd($endDate);
            $event->setPathImage($faker->imageUrl);

            if (!empty($shops)) {
                $shop = $shops[array_rand($shops)];
                $event->setShop($shop);
            }

            if (!empty($cities)) {
                $city = $cities[array_rand($cities)];
                $event->setCity($city);
            }

            $manager->persist($event);
        }

        $manager->flush();
    }

    public function getDependencies():array
    {
        return [
            ShopFixtures::class,
            CityFixtures::class,
        ];
    }
}