<?php

namespace App\DataFixtures;

use App\Entity\ForumMessage;
use App\Entity\ForumSubject;
use App\Entity\Users;
use App\Config\ForumMessageStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ForumMessageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Récupère les utilisateurs et les sujets de forum existants
        $userRepository = $manager->getRepository(Users::class);
        $forumSubjectRepository = $manager->getRepository(ForumSubject::class);

        for ($i = 0; $i < 20; $i++) {
            $forumMessage = new ForumMessage();
            $forumMessage->setMessage($faker->text);
            $forumMessage->setDateCreation($faker->dateTimeThisYear);
            $forumMessage->setDateEdit($faker->dateTimeThisYear);
            $forumMessage->setMessageStatus($faker->randomElement([ForumMessageStatus::active, ForumMessageStatus::active]));

            // Associe un utilisateur et un sujet de forum existants
            $user = $userRepository->findOneBy([], ['id' => 'ASC']);
            $forumSubject = $forumSubjectRepository->findOneBy([], ['id' => 'ASC']);
            
            if ($user && $forumSubject) {
                $forumMessage->setUser($user);
                $forumMessage->setForumSubject($forumSubject);
            }

            $manager->persist($forumMessage);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UsersFixtures::class,
            ForumSubjectFixtures::class,
        ];
    }
}
