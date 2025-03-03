<?php

namespace App\Repository;

use App\Entity\FicheShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheShop>
 */
class FicheShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheShop::class);
    }

    public function addInfo($name, $value, $icon): void
    {
        $infoFicheShop = new FicheShop();
        $infoFicheShop->setName($name);
        $infoFicheShop->setValue($value);
        $infoFicheShop->setIcon($icon);

        $this->_em->persist($infoFicheShop);
        $this->_em->flush();
    }
    //    /**
    //     * @return FicheShop[] Returns an array of FicheShop objects
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

    //    public function findOneBySomeField($value): ?FicheShop
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
