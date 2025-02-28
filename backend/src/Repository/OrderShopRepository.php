<?php

namespace App\Repository;

use App\Entity\OrderShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderShop>
 */
class OrderShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderShop::class);
    }

    /* *
 * Finds and returns OrderShop entities by status.
 *
 * @param string $status The status of the order shop.
 * @return OrderShop[] Returns an array of OrderShop objects.
 */
public function findByStatut(string $status): array
{
    return $this->createQueryBuilder('os')
        ->andWhere('os.statut = :status')
        ->setParameter('status', $status)
        ->orderBy('os.id', 'ASC')
        ->getQuery()
        ->getResult();
}

    //    /**
    //     * @return OrderShop[] Returns an array of OrderShop objects
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

    //    public function findOneBySomeField($value): ?OrderShop
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
