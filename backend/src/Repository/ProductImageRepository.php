<?php

namespace App\Repository;

use App\Entity\ProductImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductImage>
 */
class ProductImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductImage::class);
    }

    /**
     * Trouver les images par produit
     *
     * @param int $productId
     * @return ProductImage[] Retourne un tableau d'objets ProductImage
     */
    public function findByProduct(int $productId): array
    {
        return $this->createQueryBuilder('pi')
            ->andWhere('pi.product = :productId')
            ->setParameter('productId', $productId)
            ->orderBy('pi.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver une image spécifique par son nom
     *
     * @param string $imageName
     * @return ProductImage|null Retourne une image ou null si aucune image ne correspond
     */
    public function findOneByName(string $imageName): ?ProductImage
    {
        return $this->createQueryBuilder('pi')
            ->andWhere('pi.name = :imageName')
            ->setParameter('imageName', $imageName)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
