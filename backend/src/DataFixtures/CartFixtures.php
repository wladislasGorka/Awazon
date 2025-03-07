<?php

namespace App\DataFixtures;
use App\Entity\Cart;
use App\Entity\Product;
use App\Entity\Members;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CartFixtures extends Fixture
{
    CONST CART_REFERENCE = 'cart-';
    

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $cart = new Cart();
            $cart->setAddTime($faker->dateTimeBetween('-6 months'));
            $cart->setMemberId($this->getReference(UsersFixtures::MEMBER_REFERENCE . $i . '-member'));
            
            $cart->setProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE . $i));
            $cart->setQuantity($faker->numberBetween(1, 10));
            $cart->setIsOrdered($faker->boolean);

            $manager->persist($cart);

            $referenceName = self::CART_REFERENCE . $i;
            $this->addReference($referenceName, $cart);

            dump($referenceName);
            dump($cart);
        }

        $manager->flush();
    }
}
