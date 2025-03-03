<?php

namespace App\Repository;

use App\Entity\Sales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sales>
 */
class SalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sales::class);
    }

    public function updateSales($id, $slogan, $description, $pourcent, $date_start, $date_end, $salesImage, $salesTarget, $shop): void
    {
        $sales = $this->find($id);
        $sales->setSlogan($slogan);
        $sales->setDescription($description);
        $sales->setPourcent($pourcent);
        $sales->setDateStart($date_start);
        $sales->setDateEnd($date_end);
        $sales->setSalesImage($salesImage);
        $sales->setSalesTarget($salesTarget);
        $sales->setShop($shop);

        $this->_em->persist($sales);
        $this->_em->flush();
    }

    //    /**
    //     * @return Sales[] Returns an array of Sales objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }


    //    public function findOneBySomeField($value): ?Sales
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
