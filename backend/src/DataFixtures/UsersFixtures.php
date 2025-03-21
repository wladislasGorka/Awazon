<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Merchant;
use App\Entity\Member;
use App\Entity\SuperAdmin;
use App\Config\UsersRole;
use App\Config\UsersStatus;
use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class UsersFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;
    public const MERCHANT_REFERENCE = 'merchant-';
    public const MEMBER_REFERENCE = 'member-';

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $registerDate = new \DateTimeImmutable();

        // Création de Membres
        for ($i = 0; $i < 5; $i++) {
            $member = new Member();
            $member->setName($faker->lastName);
            $member->setFirstName($faker->firstName);
            $member->setEmail($faker->email);
            $member->setPhone($faker->randomNumber(9, true)); // Utilisation de randomNumber
            $member->setRegisterDate(new \DateTimeImmutable());
            //dump($member->getRegisterDate()); // Vérifier la valeur définie

            $member->setLoginDate(new \DateTimeImmutable());
            $member->setEmailVerif(true);
            $member->setStatus(UsersStatus::enabled);
            $member->setRole(UsersRole::Member);
            $member->setImgProfil('default_profile.jpg'); // Définir une valeur pour imgProfil
            $member->setPaypalAccount($faker->safeEmail); // Utiliser safeEmail pour simuler un compte PayPal
            $member->setPaypalId($faker->uuid);
 
            // Récupérer une ville aléatoire
 $cityReference = CityFixtures::CITY_REFERENCE . City::class;
 /** @phpstan-ignore-next-line */
 if ($this->hasReference($cityReference,City::class)) {
     $city = $this->getReference($cityReference, City::class);
     $member->setCity($city);} // Définir la ville

            $hashedPassword = $this->passwordHasher->hashPassword($member, 'password');
            $member->setPassword($hashedPassword);

            $manager->persist($member);
            $this->addReference(self::MEMBER_REFERENCE . $i, $member);
 
        }

        // Création de Marchands
        for ($i = 0; $i < 3; $i++) {
            $merchant = new Merchant();
            $merchant->setName($faker->lastName);
            $merchant->setFirstName($faker->firstName);
            $merchant->setEmail($faker->email);
            $merchant->setPhone(intval($faker->phoneNumber)); // Correction: Convertir en entier
            $merchant->setRegisterDate(new \DateTimeImmutable());
            $merchant->setLoginDate(new \DateTimeImmutable());
            $merchant->setEmailVerif(true);
            $merchant->setStatus(UsersStatus::enabled);
            $merchant->setRole(UsersRole::Merchant);

            $hashedPassword = $this->passwordHasher->hashPassword($merchant, 'password');
            $merchant->setPassword($hashedPassword);

            $merchant->setAddress($faker->address);
            $merchant->setKbis($faker->numerify('##########'));

            // Récupérer une vile aléatoire
            $cityReference = CityFixtures::CITY_REFERENCE . $faker->numberBetween(0, 3);
           /** @phpstan-ignore-next-line */ if ($this->hasReference($cityReference, city::class)) {
                $city = $this->getReference($cityReference, City::class);
                $merchant->setCity($city);} // Définir la ville

            $manager->persist($merchant);
            $this->addReference(self::MERCHANT_REFERENCE . $i, $merchant);
        }
        // Création d'Admin
        $admin = new Admin();
        $admin->setName('Admin');
        $admin->setFirstName('AdminFirstName');
        $admin->setEmail('admin@example.com');
        $admin->setPhone(intval($faker->phoneNumber)); // Correction: Convertir en entier
        $admin->setRegisterDate(new \DateTimeImmutable());
        $admin->setLoginDate(new \DateTimeImmutable());
        $admin->setEmailVerif(true);
        $admin->setStatus(UsersStatus::enabled);
        $admin->setRole(UsersRole::Admin);

        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'password');
        $admin->setPassword($hashedPassword);

        $manager->persist($admin);

        // Création de SuperAdmin
        $superAdmin = new SuperAdmin();
        $superAdmin->setName('SuperAdmin');
        $superAdmin->setFirstName('SuperAdminFirstName');
        $superAdmin->setEmail('superadmin@example.com');
        $superAdmin->setPhone(intval($faker->phoneNumber)); // Correction: Convertir en entier
        $superAdmin->setRegisterDate(new \DateTimeImmutable());
        $superAdmin->setLoginDate(new \DateTimeImmutable());
        $superAdmin->setEmailVerif(true);
        $superAdmin->setStatus(UsersStatus::enabled);
        $superAdmin->setRole(UsersRole::SuperAdmin);

        $hashedPassword = $this->passwordHasher->hashPassword($superAdmin, 'password');
        $superAdmin->setPassword($hashedPassword);

        $manager->persist($superAdmin);

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            CityFixtures::class,
        ];
    }
}