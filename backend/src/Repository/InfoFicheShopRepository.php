<?php

namespace App\Repository;

use App\Entity\InfoFicheShop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InfoFicheShop>
 */
class InfoFicheShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfoFicheShop::class);
    }


    /* *
 * Adds information to a shop profile.
 *
 * @param string $name The name of the information field.
 * @param string $value The value of the information field.
 * @param string $icon The icon associated with the information.
 * @return void
 */
public function addInfo(string $name, string $value, string $icon): void
{
    $infoFicheShop = new infoFicheShop();
    $infoFicheShop->setName($name);
    $infoFicheShop->setValue($value);
    $infoFicheShop->setIcon($icon);

    $this->_em->persist($infoFicheShop);
    $this->_em->flush();
}

    //    /**
    //     * @return InfoFicheShop[] Returns an array of InfoFicheShop objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?InfoFicheShop
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
