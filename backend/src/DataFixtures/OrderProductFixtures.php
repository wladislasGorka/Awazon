<?php

namespace App\DataFixtures;

use App\Entity\OrderProduct;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Créer des relations OrderProduct
        for ($i = 0; $i < 20; $i++) {
            $orderProduct = new OrderProduct();
            $orderProduct->setQuantity($faker->numberBetween(1, 10));

            // Récupérer une commande et un produit aléatoires
            $orderReference = 'order-' . $faker->numberBetween(0, 4); // Référence existante dans OrderFixtures
            $productReference = 'product-' . $faker->numberBetween(0, 9); // Référence existante dans ProductFixtures

            if ($this->hasReference($orderReference , order::class) && $this->hasReference($productReference, product::class)) {
                $order = $this->getReference($orderReference, order::class);
                $product = $this->getReference($productReference, product::class);

                $orderProduct->setOrderId($order);
                $orderProduct->setProduct($product);

                // Calculer le prix total basé sur la quantité et le prix unitaire
                $totalPrice = $product->getPrice() * $orderProduct->getQuantity();
                $orderProduct->setTotalPrice($totalPrice);

                $manager->persist($orderProduct);
            } else {
                error_log("Reference not found for order or product: $orderReference, $productReference");
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrderFixtures::class,
            ProductFixtures::class,
        ];
    }
}
