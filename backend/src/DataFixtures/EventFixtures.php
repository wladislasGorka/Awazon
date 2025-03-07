<?php

namespace App\DataFixtures;
use App\Entity\Event;
use App\Entity\City;
use App\Entity\Merchant;
use App\Entity\Shop;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EventFixtures extends Fixture

{
    CONST EVENT_REFERENCE = 'event-';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $event = new Event();
            $event->setName($faker->sentence(3));
            $event->setDescription($faker->text);
            $event->setDateStart($faker->dateTimeBetween('-6 months'));
            $event->setDateEnd($faker->dateTimeBetween('-6 months'));
            $event->setCity($this->getReference(CityFixtures::CITY_REFERENCE . $i));
            $event->setMerchant($this->getReference(MerchantFixtures::MERCHANT_REFERENCE . $i));
            $event->setShop($this->getReference(ShopFixtures::SHOP_REFERENCE . $i));
            $event->setPathImage($faker->imageUrl(640, 480, 'events', true));

            $manager->persist($event);

            $referenceName = self::EVENT_REFERENCE . $i;
            $this->addReference($referenceName, $event);

            dump($referenceName);
            dump($event);
        }


        $manager->flush();
    }
}
