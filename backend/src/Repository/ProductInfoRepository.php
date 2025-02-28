<?php

namespace App\Repository;

use App\Entity\ProductInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductInfo>
 */
class ProductInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductInfo::class);
    }

    /* *
 * Updates the information of a product.
 *
 * @param string $name The name of the information field to update.
 * @param string $value The value to set for the information field.
 * @return void
 */
public function updateInfo(string $name, string $value): void
{
    $productInfo = $this->findOneBy(['name' => $name]);
    if ($productInfo) {
        $productInfo->setValue($value);
        $this->_em->persist($productInfo);
        $this->_em->flush();
    }
}


    //    /**
    //     * @return ProductInfo[] Returns an array of ProductInfo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProductInfo
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
