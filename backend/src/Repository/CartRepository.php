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
     * Calculer le prix total pour un produit spécifique dans un panier.
     */
    public function calcPriceByIdProduct(Cart $cart, int $productId): float
    {
        $totalPrice = 0.0;
        foreach ($cart->getCarts() as $cartItem) {
            if ($cartItem->getProduct()->getId() === $productId) {
                $totalPrice += $cartItem->getProduct()->getPrice() * $cartItem->getQuantity();
            }
        }
        return $totalPrice;
    }

    /* *
    * Calculates the total quantity of all items in the cart.
    *
    * @param Cart $cart The cart object.
    * @return int The total quantity of all items in the cart.
    */
    public function calcTotalQuantity(Cart $cart): int
    {
        // Puisque chaque instance de Cart représente un seul produit,
        // renvoyez simplement la quantité associée.
        return $cart->getQuantity();
    }

    public function findByProduct($memberId): array
    {
            $query = $this->createQueryBuilder('c')
                ->select('c', 'p.price', 'p.name')
                ->innerJoin('c.product', 'p')
                ->andWhere('c.member = :val')
                ->setParameter('val', $memberId)
                ->getQuery();
            return $query->getResult();
    }
    // Trouver les paniers dans un array
    public function findByProductsId($userId, Array $productsId)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->andWhere('c.member = :userId')
            ->setParameter('userId', $userId);

        foreach ($productsId as $id) {
            $qb->orWhere('c.product = :id')
                ->setParameter('id', $id);
        }

        return $qb->getQuery()->getResult();

    }


    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Cart
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
