<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

     /* *
 * Finds and returns all orders.
 *
 * @return Order[] Returns an array of Order objects.
 */
public function findByAll(): array
{
    return $this->createQueryBuilder('o')
        ->orderBy('o.id', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds and returns an order by its number.
 *
 * @param int $number The number of the order.
 * @return Order|null The order with the specified number or null if not found.
 */
public function findByNumber(int $number): ?Order
{
    return $this->createQueryBuilder('o')
        ->andWhere('o.number = :number')
        ->setParameter('number', $number)
        ->getQuery()
        ->getOneOrNullResult();
}

/* *
 * Finds and returns orders by a specific date.
 *
 * @param \DateTimeInterface $date The date to search orders by.
 * @return Order[] Returns an array of Order objects.
 */
public function findByDate(\DateTimeInterface $date): array
{
    return $this->createQueryBuilder('o')
        ->andWhere('o.creation_date = :date')
        ->setParameter('date', $date)
        ->orderBy('o.id', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds and returns orders by user ID.
 *
 * @param int $userId The ID of the user.
 * @return Order[] Returns an array of Order objects.
 */
public function findByUser(int $userId): array
{
    return $this->createQueryBuilder('o')
        ->andWhere('o.memberId = :userId')
        ->setParameter('userId', $userId)
        ->orderBy('o.id', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds and returns orders by shop ID.
 *
 * @param int $shopId The ID of the shop.
 * @return Order[] Returns an array of Order objects.
 */
public function findByShop(int $shopId): array
{
    return $this->createQueryBuilder('o')
        ->innerJoin('o.shops', 's')
        ->andWhere('s.shopId = :shopId')
        ->setParameter('shopId', $shopId)
        ->orderBy('o.id', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds and returns orders by status.
 *
 * @param OrderStatus $status The status of the orders.
 * @return Order[] Returns an array of Order objects.
 */
public function findByStatus(OrderStatus $status): array
{
    return $this->createQueryBuilder('o')
        ->andWhere('o.status = :status')
        ->setParameter('status', $status)
        ->orderBy('o.id', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds and returns orders by billing address.
 *
 * @param string $address The billing address of the orders.
 * @return Order[] Returns an array of Order objects.
 */
public function findByAddress(string $address): array
{
    return $this->createQueryBuilder('o')
        ->andWhere('o.address_bill = :address')
        ->setParameter('address', $address)
        ->orderBy('o.id', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds and returns orders by shop name.
 *
 * @param string $name The name of the shop.
 * @return Order[] Returns an array of Order objects.
 */
public function findByShopName(string $name): array
{
    return $this->createQueryBuilder('o')
        ->innerJoin('o.shops', 's')
        ->andWhere('s.name = :name')
        ->setParameter('name', $name)
        ->orderBy('o.id', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Calculates the total price of all products in an order.
 *
 * @param Order $order The order object.
 * @return float The total price of all products in the order.
 */
public function calcTotalPrice(Order $order): float
{
    $totalPrice = 0.0;
    foreach ($order->getProducts() as $orderProduct) {
        $totalPrice += $orderProduct->getProduct()->getPrice() * $orderProduct->getQuantity();
    }
    return $totalPrice;
}

/* *
 * Finds and returns all products associated with an order.
 *
 * @param Order $order The order object.
 * @return Product[] Returns an array of Product objects.
 */
public function findAllProducts(Order $order): array
{
    $products = [];
    foreach ($order->getProducts() as $orderProduct) {
        $products[] = $orderProduct->getProduct();
    }
    return $products;
}

    //    /**
    //     * @return Order[] Returns an array of Order objects
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

    //    public function findOneBySomeField($value): ?Order
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
