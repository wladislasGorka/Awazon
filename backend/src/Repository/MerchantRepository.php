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

/* *
 * Finds merchants by the specified type.
 *
 * @param string $type The type to search for.
 * @return Merchant[] An array of merchants of the specified type.
 */
public function findByType(string $type): array
{
    return $this->createQueryBuilder('m')
        ->andWhere('m.type = :type')
        ->setParameter('type', $type)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds merchants by the specified name.
 *
 * @param string $name The name to search for.
 * @return Merchant[] An array of merchants with the specified name.
 */
public function findByName(string $name): array
{
    return $this->createQueryBuilder('m')
        ->andWhere('m.name = :name')
        ->setParameter('name', $name)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds merchants by the specified address.
 *
 * @param string $address The address to search for.
 * @return Merchant[] An array of merchants with the specified address.
 */
public function findByAddress(string $address): array
{
    return $this->createQueryBuilder('m')
        ->andWhere('m.address = :address')
        ->setParameter('address', $address)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds merchants by the specified category.
 *
 * @param string $category The category to search for.
 * @return Merchant[] An array of merchants in the specified category.
 */
public function findByCategory(string $category): array
{
    return $this->createQueryBuilder('m')
        ->andWhere('m.category = :category')
        ->setParameter('category', $category)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds merchants by the specified status.
 *
 * @param string $status The status to search for.
 * @return Merchant[] An array of merchants with the specified status.
 */
public function findByStatut(string $status): array
{
    return $this->createQueryBuilder('m')
        ->andWhere('m.status = :status')
        ->setParameter('status', $status)
        ->getQuery()
        ->getResult();
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
