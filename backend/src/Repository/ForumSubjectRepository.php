<?php

namespace App\Repository;

use App\Entity\ForumSubject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumSubject>
 */
class ForumSubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumSubject::class);
    }

    /* *
 * Finds discussions by the specified name.
 *
 * @param string $name The name to search for.
 * @return Discussion[] An array of discussions with the specified name.
 */
public function findByName(string $name): array
{
    return $this->createQueryBuilder('d')
        ->andWhere('d.name = :name')
        ->setParameter('name', $name)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds discussions by the specified section.
 *
 * @param int $sectionId The ID of the section to search for.
 * @return Discussion[] An array of discussions in the specified section.
 */
public function findBySection(int $sectionId): array
{
    return $this->createQueryBuilder('d')
        ->andWhere('d.sectionId = :sectionId')
        ->setParameter('sectionId', $sectionId)
        ->getQuery()
        ->getResult();
}


    //    /**
    //     * @return ForumSubject[] Returns an array of ForumSubject objects
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

    //    public function findOneBySomeField($value): ?ForumSubject
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
