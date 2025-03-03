<?php

namespace App\Repository;

use App\Entity\OrderProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderProduct>
 */
class OrderProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderProduct::class);
    }

    /* *
 * Calculates the total price of all products in an order.
 *
 * @param int $orderId The ID of the order.
 * @return float The total price of all products in the order.
 */
public function calcTotalPrice(int $orderId): float
{
    $totalPrice = 0.0;
    // Find all OrderProduct entities related to the given order ID
    $orderProducts = $this->createQueryBuilder('op')
        ->andWhere('op.orderId = :orderId')
        ->setParameter('orderId', $orderId)
        ->getQuery()
        ->getResult();

    // Iterate through each OrderProduct to calculate the total price
    foreach ($orderProducts as $orderProduct) {
        $totalPrice += $orderProduct->getProduct()->getPrice() * $orderProduct->getQuantity();
    }

    return $totalPrice;
}


    //    /**
    //     * @return OrderProduct[] Returns an array of OrderProduct objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OrderProduct
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
