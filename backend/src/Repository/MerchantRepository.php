<?php

namespace App\Repository;

use App\Entity\Merchant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Merchant>
 */
class MerchantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Merchant::class);
    }


    /* *
 * Updates the contact information of a merchant.
 *
 * @param int $merchantId The ID of the merchant.
 * @param string $address The new address.
 * @param string $number The new contact number.
 * @return void
 */
public function updateContact(int $merchantId, string $address, string $number): void
{
    $merchant = $this->find($merchantId);
    if ($merchant) {
        $merchant->setAddress($address);
        $merchant->setNumber($number);
        $this->_em->persist($merchant);
        $this->_em->flush();
    }
}


    //    /**
    //     * @return Merchant[] Returns an array of Merchant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Merchant
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
