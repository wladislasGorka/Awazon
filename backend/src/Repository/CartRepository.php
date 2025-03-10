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

   /* *
 * Finds and returns the cart associated with a specific user.
 *
 * @param int $userId The ID of the user.
 * @return Cart|null The cart associated with the user or null if not found.
 */
    public function findCartByUser($user): ?Cart
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :val')
            ->setParameter('val', $user)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
/* *
 * Calculates the total price of all items in the cart.
 *
 * @param Cart $cart The cart object.
 * @return float The total price of all items in the cart.
 */
    public function calcTotalPrice(Cart $cart): float
    {
        $totalPrice = 0.0;
        foreach ($cart->getCarts() as $cartItem) {
            $totalPrice += $cartItem->getProduct()->getPrice() * $cartItem->getQuantity();
        }
        return $totalPrice;
    }


    /* *
 * Calculates the total price of a specific product in the cart based on its ID.
 *
 * @param Cart $cart The cart object.
 * @param int $productId The ID of the product.
 * @return float The total price of the product in the cart.
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
    $totalQuantity = 0;
    foreach ($cart->getCarts() as $cartItem) {
        $totalQuantity += $cartItem->getQuantity();
    }
    return $totalQuantity;
}

public function findByProduct($memberId): array
{
        $query = $this->createQueryBuilder('c')
            ->select('c', 'p.price', 'p.name')
            ->innerJoin('c.productId', 'p')
            ->andWhere('c.memberId = :val')
            ->setParameter('val', $memberId)
            ->getQuery();
        return $query->getResult();
}
// Trouver les paniers dans un array
public function findByProductsId($userId, Array $productsId)
{
    $qb = $this->createQueryBuilder('c');

    $qb->andWhere('c.memberId = :userId')
        ->setParameter('userId', $userId);

    foreach ($productsId as $id) {
        $qb->orWhere('c.productId = :id')
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


