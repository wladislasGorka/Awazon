<?php

namespace App\Repository;

use App\Entity\Shop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Shop>
 */
class ShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shop::class);
    }

    /* *
 * Updates a shop with new information.
 *
 * @param int $shopId The ID of the shop.
 * @param array $data An associative array of fields to update.
 * @return void
 */
public function updateShop(int $shopId, array $data): void
{
    $shop = $this->find($shopId);
    if ($shop) {
        foreach ($data as $field => $value) {
            $method = 'set' . ucfirst($field);
            if (method_exists($shop, $method)) {
                $shop->$method($value);
            }
        }
        $this->_em->persist($shop);
        $this->_em->flush();
    }
}

/* *
 * Sets the address of a shop with longitude and latitude.
 *
 * @param int $shopId The ID of the shop.
 * @param float $longitude The longitude of the shop.
 * @param float $latitude The latitude of the shop.
 * @return void
 */
public function setAddress(int $shopId, float $longitude, float $latitude): void
{
    $shop = $this->find($shopId);
    if ($shop) {
        $shop->setLongitude($longitude);
        $shop->setLatitude($latitude);
        $this->_em->persist($shop);
        $this->_em->flush();
    }
}

/* *
 * Finds shops by the specified type.
 *
 * @param string $type The type to search for.
 * @return Shop[] An array of shops of the specified type.
 */
public function findByType(string $type): array
{
    return $this->createQueryBuilder('s')
        ->andWhere('s.type = :type')
        ->setParameter('type', $type)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds shops by the specified name.
 *
 * @param string $name The name to search for.
 * @return Shop[] An array of shops with the specified name.
 */
public function findByName(string $name): array
{
    return $this->createQueryBuilder('s')
        ->andWhere('s.name = :name')
        ->setParameter('name', $name)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds shops by the specified address.
 *
 * @param string $address The address to search for.
 * @return Shop[] An array of shops with the specified address.
 */
public function findByAddress(string $address): array
{
    return $this->createQueryBuilder('s')
        ->andWhere('s.address = :address')
        ->setParameter('address', $address)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds shops by the specified category.
 *
 * @param string $category The category to search for.
 * @return Shop[] An array of shops in the specified category.
 */
public function findByCategory(string $category): array
{
    return $this->createQueryBuilder('s')
        ->andWhere('s.category = :category')
        ->setParameter('category', $category)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds shops by the specified status.
 *
 * @param string $status The status to search for.
 * @return Shop[] An array of shops with the specified status.
 */
public function findByStatut(string $status): array
{
    return $this->createQueryBuilder('s')
        ->andWhere('s.status = :status')
        ->setParameter('status', $status)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds shop profiles by the specified status.
 *
 * @param string $status The status to search for.
 * @return ShopProfile[] An array of shop profiles with the specified status.
 */
public function findProfileByStatut(string $status): array
{
    return $this->createQueryBuilder('sp')
        ->andWhere('sp.status = :status')
        ->setParameter('status', $status)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds users associated with the shop.
 *
 * @param int $shopId The ID of the shop.
 * @return User[] An array of users associated with the specified shop.
 */
public function findUsers(int $shopId): array
{
    return $this->createQueryBuilder('u')
        ->innerJoin('u.shop', 's')
        ->andWhere('s.id = :shopId')
        ->setParameter('shopId', $shopId)
        ->getQuery()
        ->getResult();
}


    //    /**
    //     * @return Shop[] Returns an array of Shop objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Shop
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
