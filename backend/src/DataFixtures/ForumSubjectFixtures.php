<?php

namespace App\DataFixtures;

use App\Entity\ForumSubject;
use App\Entity\ForumSection;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ForumSubjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupère les utilisateurs et les sections de forum existants
        $userRepository = $manager->getRepository(Users::class);
        $forumSectionRepository = $manager->getRepository(ForumSection::class);

        for ($i = 0; $i < 20; $i++) {
            $forumSubject = new ForumSubject();
            $forumSubject->setName($faker->sentence);

            // Associe un utilisateur et une section de forum existants
            $user = $userRepository->findOneBy([], ['id' => 'ASC']);
            $forumSection = $forumSectionRepository->findOneBy([], ['id' => 'ASC']);
            
            if ($user && $forumSection) {
                $forumSubject->setUser($user);
                $forumSubject->setForumSection($forumSection);
            }

            $manager->persist($forumSubject);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ForumSectionFixtures::class,
        ];
    }
}
