<?php

namespace App\Repository;

use App\Entity\Newsletter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Newsletter>
 */
class NewsletterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Newsletter::class);
    }

   /* *
 * Finds newsletters by the specified shop ID.
 *
 * @param int $shopId The shop ID to search for.
 * @return Newsletter[] An array of newsletters for the specified shop ID.
 */
public function findByShopId(int $shopId): array
{
    return $this->createQueryBuilder('n')
        ->andWhere('n.shopId = :shopId')
        ->setParameter('shopId', $shopId)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds a newsletter by the specified title.
 *
 * @param string $title The title to search for.
 * @return Newsletter|null The newsletter with the specified title, or null if not found.
 */
public function findByTitle(string $title): ?Newsletter
{
    return $this->createQueryBuilder('n')
        ->andWhere('n.title = :title')
        ->setParameter('title', $title)
        ->getQuery()
        ->getOneOrNullResult();
}

/* *
 * Finds a newsletter by the specified date.
 *
 * @param string $date The date to search for.
 * @return Newsletter|null The newsletter with the specified date, or null if not found.
 */
public function findByDate(string $date): ?Newsletter
{
    return $this->createQueryBuilder('n')
        ->andWhere('n.date = :date')
        ->setParameter('date', $date)
        ->getQuery()
        ->getOneOrNullResult();
}

/* *
 * Finds newsletters by the specified role.
 *
 * @param string $role The role to search for.
 * @return Newsletter[] An array of newsletters for the specified role.
 */
public function findByRole(string $role): array
{
    return $this->createQueryBuilder('n')
        ->andWhere('n.role = :role')
        ->setParameter('role', $role)
        ->getQuery()
        ->getResult();
}


    //    /**
    //     * @return Newsletter[] Returns an array of Newsletter objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Newsletter
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
