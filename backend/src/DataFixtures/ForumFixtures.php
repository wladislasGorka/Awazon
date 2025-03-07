<?php

namespace App\DataFixtures;
use App\Entity\Forum;
use App\Entity\ForumMessage;
use App\Entity\ForumSubject;
use App\Entity\ForumSection;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ForumFixtures extends Fixture
{
    CONST FORUM_MESSAGE_REFERENCE = 'forum_message-';
    CONST FORUM_SUBJECT_REFERENCE = 'forum_subject-';
    CONST FORUM_SECTION_REFERENCE = 'forum_section-';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $forum = new Forum();
            $forum->setName($faker->sentence(3));
            $forum->setDescription($faker->text);
            $forum->setCreatedAt($faker->dateTimeBetween('-6 months'));
            $forum->setUpdatedAt($faker->dateTimeBetween('-6 months'));
            $forum->setUsers($this->getReference(UserFixtures::USER_REFERENCE . $i));
            $forum->setForumSection($this->getReference(ForumSectionFixtures::FORUM_SECTION_REFERENCE . $i));
            $forum->setForumSubject($this->getReference(ForumSubjectFixtures::FORUM_SUBJECT_REFERENCE . $i));
            $forum->setForumMessage($this->getReference(ForumMessageFixtures::FORUM_MESSAGE_REFERENCE . $i));

            $manager->persist($forum);

            $referenceName = self::FORUM_REFERENCE . $i;
            $this->addReference($referenceName, $forum);

            dump($referenceName);
            dump($forum);
        }
        $manager->flush();
    }
}
