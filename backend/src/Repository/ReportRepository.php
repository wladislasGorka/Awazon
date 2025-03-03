<?php

namespace App\Repository;

use App\Entity\Report;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Report>
 */
class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    /* *
 * Finds reports by the specified service.
 *
 * @param string $service The service to search for.
 * @return Report[] An array of reports for the specified service.
 */
public function findReportByType(string $service): array
{
    return $this->createQueryBuilder('r')
        ->andWhere('r.service = :service')
        ->setParameter('service', $service)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds reports by the specified date.
 *
 * @param string $date The date to search for.
 * @return Report[] An array of reports created on the specified date.
 */
public function findReportByDate(string $date): array
{
    return $this->createQueryBuilder('r')
        ->andWhere('r.date = :date')
        ->setParameter('date', $date)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds reports by the specified sender.
 *
 * @param int $senderId The ID of the sender to search for.
 * @return Report[] An array of reports sent by the specified sender.
 */
public function findReportBySender(int $senderId): array
{
    return this->createQueryBuilder('r')
        ->andWhere('r.senderId = :senderId')
        ->setParameter('senderId', $senderId)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds reports by the specified status.
 *
 * @param string $status The status to search for.
 * @return Report[] An array of reports with the specified status.
 */
public function findReportByStatut(string $status): array
{
    return $this->createQueryBuilder('r')
        ->andWhere('r.status = :status')
        ->setParameter('status', $status)
        ->getQuery()
        ->getResult();
}


    //    /**
    //     * @return Report[] Returns an array of Report objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Report
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
