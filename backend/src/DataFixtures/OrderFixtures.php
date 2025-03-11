<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Config\OrderStatus;
use App\Entity\Member;
use App\Entity\City;
use App\Entity\GiftCode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupérer les GiftCodes
        $giftCodes = $manager->getRepository(GiftCode::class)->findAll();

        // Création de commandes fictives
        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            $order->setNumber($faker->unique()->numberBetween(1000, 9999));
            $order->setCreationDate($faker->dateTimeBetween('-6 months', '-1 month'));
            $order->setPickupDate($faker->optional()->dateTimeBetween('now', '+3 months'));
            $order->setAddressBill($faker->address);
            $order->setStatus($faker->randomElement(OrderStatus::cases()));

            $this->addReference('order-' . $i, $order);
            
            // Associer un membre aléatoire
            $usersReference = UsersFixtures::MEMBER_REFERENCE . $faker->numberBetween(0, 4);
            $member = $this->getReference($usersReference, Member::class);
            $order->setMemberId($member);

            // Associer une ville aléatoire
            $cityReference = CityFixtures::CITY_REFERENCE . $faker->numberBetween(0, 9);
            $city = $this->getReference($cityReference, city::class);
            $order->setCity($city);

            // Associer un GiftCode aléatoire (si disponible)
            if (!empty($giftCodes) && rand(0, 1)) {
                $giftCode = $giftCodes[array_rand($giftCodes)];
                $order->setGiftCode($giftCode);
            }

            $manager->persist($order);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UsersFixtures::class,
            CityFixtures::class,
            GiftcodeFixtures::class,
        ];
    }
}