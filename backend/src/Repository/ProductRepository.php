<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // Trouver les produits par filtres
    public function findByFilters(array $filters): array
    {
        $qb = $this->createQueryBuilder('p')
            ->join('p.subCategory', 'sub')
            ->join('subCategory', 'c');

        foreach ($filters as $field => $value) {
            if($field === 'category'){
                $qb->andWhere("c.name = :category")
                    ->setParameter('category', $value);
            }
            if($field === 'sub-category'){
                $qb->andWhere("sub.name = :subCategory")
                    ->setParameter('subCategory', $value);
            }
        }

        return $qb->getQuery()->getResult();
    }

    // Trouver les produits d'une boutique avec le id du marchand
    public function findByMerchant(int $merchantId): array
    {
        return $this->createQueryBuilder('p')
            ->join('p.shop', 's')
            ->join('s.merchantId', 'm')
            ->andWhere('m.id = :merchantId')
            ->setParameter('merchantId', $merchantId)
            ->getQuery()
            ->getResult();
    }

    public function findByName(string $name): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /* public function findByPriceMin(float $price): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.price >= :price')
            ->setParameter('price', $price)
            ->getQuery()
            ->getResult()
        ;
    } */

    /* *
 * Finds and returns products with a price within the specified range.
 *
 * @param float $minPrice The minimum price.
 * @param float $maxPrice The maximum price.
 * @return Product[] Returns an array of Product objects.
 */
public function findByPriceRange(float $minPrice, float $maxPrice): array
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.price >= :minPrice')
        ->andWhere('p.price <= :maxPrice')
        ->setParameter('minPrice', $minPrice)
        ->setParameter('maxPrice', $maxPrice)
        ->orderBy('p.price', 'ASC')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds products within the specified stock range.
 *
 * @param int $minStock The minimum stock value.
 * @param int $maxStock The maximum stock value.
 * @return Product[] An array of products within the specified stock range.
 */
public function findByStockRange(int $minStock, int $maxStock): array
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.stock >= :minStock')
        ->andWhere('p.stock <= :maxStock')
        ->setParameter('minStock', $minStock)
        ->setParameter('maxStock', $maxStock)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds products by the specified category.
 *
 * @param string $category The category to search for.
 * @return Product[] An array of products in the specified category.
 */
public function findByCategory(string $category): array
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.category = :category')
        ->setParameter('category', $category)
        ->getQuery()
        ->getResult();
}


/* *
 * Finds products by the specified subcategory.
 *
 * @param string $subCategory The subcategory to search for.
 * @return Product[] An array of products in the specified subcategory.
 */
public function findBySubCategory(string $subCategory): array
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.subCategory = :subCategory')
        ->setParameter('subCategory', $subCategory)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds products by the specified option.
 *
 * @param string $option The option to search for.
 * @return Product[] An array of products with the specified option.
 */
public function findByOption(string $option): array
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.option = :option')
        ->setParameter('option', $option)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds products by the specified value.
 *
 * @param string $value The value to search for.
 * @return Product[] An array of products with the specified value.
 */
public function findByValue(string $value): array
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.value = :value')
        ->setParameter('value', $value)
        ->getQuery()
        ->getResult();
}



/* *
 * Adds an option to a product.
 *
 * @param int $productId The ID of the product.
 * @param string $option The option to add.
 * @return void
 */
public function addOption(int $productId, string $option): void
{
    $product = $this->find($productId);
    if ($product) {
        $product->addOption($option);
        $this->_em->persist($product);
        $this->_em->flush();
    }
}


    //    /**
    //     * @return Product[] Returns an array of Product objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Product
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function searchProducts(string $query): array
{

    $qb = $this->createQueryBuilder('p');

    $qb->where('p.name LIKE :query OR p.description LIKE :query')
       ->setParameter('query', '%'.$query.'%')
       ->orderBy('p.name', 'ASC');

    return $qb->getQuery()->getResult();
}
}