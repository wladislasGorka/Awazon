<?php

namespace App\Repository;

<<<<<<<< HEAD:backend/src/Repository/CategoryRepository.php
use App\Entity\Category;
========
use App\Entity\Cart;
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Repository/CartRepository.php
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
<<<<<<<< HEAD:backend/src/Repository/CategoryRepository.php
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    //    /**
    //     * @return Category[] Returns an array of Category objects
========
 * @extends ServiceEntityRepository<Cart>
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    //    /**
    //     * @return Cart[] Returns an array of Cart objects
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Repository/CartRepository.php
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

<<<<<<<< HEAD:backend/src/Repository/CategoryRepository.php
    //    public function findOneBySomeField($value): ?Category
========
    //    public function findOneBySomeField($value): ?Cart
>>>>>>>> 67fecfdc2600c5892a4d0c637be6ea36a2214c1d:backend/src/Repository/CartRepository.php
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
