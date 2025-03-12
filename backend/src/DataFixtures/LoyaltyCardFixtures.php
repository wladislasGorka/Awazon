<?php

namespace App\DataFixtures;

use App\Entity\Member;
use App\Entity\LoyaltyCard;
use App\Entity\Level;
use App\DataFixtures\UsersFixtures;
use App\DataFixtures\LevelFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LoyaltyCardFixtures extends Fixture implements DependentFixtureInterface
{
    public const MEMBER_REFERENCE = 'member-';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Utilisation des références des niveaux créés dans LevelFixtures
        $levels = [];
        for ($i = 0; $i < 3; $i++) {
            $levels[] = $this->getReference(LevelFixtures::LEVEL_REFERENCE . $i, Level::class); // Correction ici
        }

        // Utilisation des références des membres créés dans UsersFixtures
        for ($i = 0; $i < 5; $i++) {
            /** @var Member $member */
            $member = $this->getReference(UsersFixtures::MEMBER_REFERENCE . $i, Member::class); // Correction ici

            // Créer une carte de fidélité pour chaque membre
            $loyaltyCard = new LoyaltyCard();
            $loyaltyCard->setPoints($faker->numberBetween(0, 1000))
                ->setCumulPoint($faker->numberBetween(1000, 5000))
                ->setLevel($faker->randomElement(['Silver', 'Gold', 'Platinum']))
                ->setLevelid($faker->randomElement($levels)) // Associer un niveau existant
                ->setMember($member); // Associer un membre existant
            $manager->persist($loyaltyCard);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UsersFixtures::class, // Dépend de UsersFixtures pour les membres
            LevelFixtures::class, // Dépend de LevelFixtures pour les niveaux
        ];
    }
}