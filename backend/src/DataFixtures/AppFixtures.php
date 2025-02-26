<?php

namespace App\DataFixtures;

use App\Factory\AdminFactory;
use App\Factory\MemberFactory;
use App\Factory\MerchantFactory;
use App\Factory\SuperAdminFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // $manager->flush();

        // create 10 Member's
        MemberFactory::createMany(10);
        // create 10 Merchant's
        MerchantFactory::createMany(10);
        // create 5 Admin's
        AdminFactory::createMany(5);
        // create 1 SuperAdmin's
        SuperAdminFactory::createMany(1);
    }
}
