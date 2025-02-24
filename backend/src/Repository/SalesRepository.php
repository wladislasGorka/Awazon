<?php

namespace App\Repository;

<<<<<<<< HEAD:backend/src/Repository/SalesRepository.php
use App\Entity\Sales;
========
use App\Entity\Event;
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Repository/EventRepository.php
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
<<<<<<<< HEAD:backend/src/Repository/SalesRepository.php
 * @extends ServiceEntityRepository<Sales>
 */
class SalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sales::class);
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
========
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    //    /**
    //     * @return Event[] Returns an array of Event objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Repository/EventRepository.php
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

<<<<<<<< HEAD:backend/src/Repository/SalesRepository.php
    //    public function findOneBySomeField($value): ?Sales
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
========
    //    public function findOneBySomeField($value): ?Event
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Repository/EventRepository.php
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
