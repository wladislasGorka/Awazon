<?php

namespace App\DataFixtures;

use App\Entity\GiftCode;
use App\Entity\GiftCodeTarget;
use App\Config\GiftCodeTargetType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class GiftCodeTargetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupère les gift codes existants
        $giftCodeRepository = $manager->getRepository(GiftCode::class);
        $giftCodes = $giftCodeRepository->findAll();

        for ($i = 0; $i < 20; $i++) {
            $giftCodeTarget = new GiftCodeTarget();
            $giftCodeTarget->setType($faker->randomElement([GiftCodeTargetType::ProductCategory, GiftCodeTargetType::Product]));
            $giftCodeTarget->setTargetId($faker->numberBetween(1, 100));

            // Associe un gift code aléatoire
            if (!empty($giftCodes)) {
                $giftCode = $giftCodes[array_rand($giftCodes)];
                $giftCodeTarget->setGiftCode($giftCode);
            }

            $manager->persist($giftCodeTarget);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            GiftcodeFixtures::class,
        ];
    }
}