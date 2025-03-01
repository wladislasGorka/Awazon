<?php

namespace App\Repository;

use App\Entity\ForumSection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumSection>
 */
class ForumSectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumSection::class);
    }

    /* *
 * Finds sections by the specified role.
 *
 * @param string $role The role to search for.
 * @return Section[] An array of sections for the specified role.
 */
public function findByRole(string $role): array
{
    return $this->createQueryBuilder('s')
        ->andWhere('s.role = :role')
        ->setParameter('role', $role)
        ->getQuery()
        ->getResult();
}

    //    /**
    //     * @return ForumSection[] Returns an array of ForumSection objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ForumSection
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
