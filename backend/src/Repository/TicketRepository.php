<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ticket>
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    /* *
 * Finds tickets by the specified service.
 *
 * @param string $service The service to search for.
 * @return Ticket[] An array of tickets for the specified service.
 */
public function findByTicketService(string $service): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.service = :service')
        ->setParameter('service', $service)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds tickets by the specified date range.
 *
 * @param string $firstDate The start date to search for.
 * @param string $lastDate The end date to search for.
 * @return Ticket[] An array of tickets within the specified date range.
 */
public function findByTicketDate(string $firstDate, string $lastDate): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.date BETWEEN :firstDate AND :lastDate')
        ->setParameter('firstDate', $firstDate)
        ->setParameter('lastDate', $lastDate)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds tickets by the specified sender.
 *
 * @param int $senderId The ID of the sender to search for.
 * @return Ticket[] An array of tickets sent by the specified sender.
 */
public function findTicketBySender(int $senderId): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.senderId = :senderId')
        ->setParameter('senderId', $senderId)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds tickets by the specified status.
 *
 * @param string $status The status to search for.
 * @return Ticket[] An array of tickets with the specified status.
 */
public function findByStatus(string $status): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.status = :status')
        ->setParameter('status', $status)
        ->getQuery()
        ->getResult();
}

//    /**
//     * @return Ticket[] Returns an array of Ticket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ticket
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
