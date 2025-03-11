<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    /**
     * Trouver un panier associé à un utilisateur spécifique.
     */
    public function findCartByUser($user): ?Cart
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.member = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Calculer le prix total d'un panier.
     */
    public function calcTotalPrice(Cart $cart): float
    {
        $product = $cart->getProduct();
        if ($product === null) {
            return 0.0;
        }

        return $product->getPrice() * $cart->getQuantity();
    }

    /**
     * Calculer la quantité totale d'articles dans un panier.
     */
    public function calcTotalQuantity(Cart $cart): int
    {
        return $cart->getQuantity();
    }

    /**
     * Calculer le prix total pour un produit spécifique dans un panier.
     */
    public function calcPriceByIdProduct(Cart $cart, int $productId): float
    {
        $product = $cart->getProduct();
        if ($product === null || $product->getId() !== $productId) {
            return 0.0;
        }

        return $product->getPrice() * $cart->getQuantity();
    }
}
