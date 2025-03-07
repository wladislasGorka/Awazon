<?php

namespace App\Repository;

use App\Entity\Sales;
use App\Entity\Shop; 
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;


/**
 * @extends ServiceEntityRepository<Sales>
 */
class SalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sales::class);
    }

    /**
     * Met à jour une promotion existante.
     *
     * @param int $id
     * @param string $slogan
     * @param string $description
     * @param float $pourcent
     * @param \DateTimeInterface $date_start
     * @param \DateTimeInterface $date_end
     * @param array $salesImage
     * @param string $salesTarget
     * @param Shop $shop
     */
    public function updateSales(int $id, string $slogan, string $description, float $pourcent, \DateTimeInterface $date_start, \DateTimeInterface $date_end, array $salesImage, string $salesTarget, Shop $shop): void
    {
        $sales = $this->find($id);

        if (!$sales) {
            throw $this->createNotFoundException('No sales found for id ' . $id);
        }

        $sales->setSlogan($slogan);
        $sales->setDescription($description);
        $sales->setPourcent($pourcent);
        $sales->setDateStart($date_start);
        $sales->setDateEnd($date_end);
        $sales->setSalesImage($salesImage);
        $sales->setSalesTarget($salesTarget);
        $sales->setShop($shop);

        $this->_em->persist($sales);
        $this->_em->flush();
    }

    /**
     * Trouve les promotions par un exemple de champ.
     *
     * @param mixed $value
     * @return Sales[]
     */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Trouve une promotion par un champ spécifique.
     *
     * @param mixed $value
     * @return Sales|null
     */
    public function findOneBySomeField($value): ?Sales
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    /**
     * Récupère toutes les promotions.
     *
     * @return Sales[]
     */
    public function findAll(): array
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
