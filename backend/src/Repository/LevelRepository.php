<?php

namespace App\Repository;

use App\Entity\Level;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Level>
 */
class LevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Level::class);
    }

    /**
     * Récupérer tous les niveaux triés par ID.
     *
     * @return Level[] Returns an array of Level objects
     */
    public function findAllLevels(): array
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Rechercher les niveaux par titre.
     *
     * @param string $title Le titre ou une partie du titre
     * @return Level[] Returns an array of Level objects
     */
    public function findByTitle(string $title): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.title LIKE :title')
            ->setParameter('title', '%' . $title . '%') // Recherche partielle
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver un niveau par ID.
     *
     * @param int $id L'identifiant du niveau
     * @return Level|null Returns a Level object or null
     */
    public function findOneById(int $id): ?Level
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Trouver les niveaux qui ont un certain nombre de cartes de fidélité associées.
     *
     * @param int $minCards Nombre minimum de cartes de fidélité
     * @return Level[] Returns an array of Level objects
     */
    public function findLevelsByMinLoyaltyCards(int $minCards): array
    {
        return $this->createQueryBuilder('l')
            ->join('l.loyaltyCards', 'lc') // Jointure sur les cartes de fidélité
            ->groupBy('l.id')
            ->having('COUNT(lc.id) >= :minCards')
            ->setParameter('minCards', $minCards)
            ->getQuery()
            ->getResult();
    }
}
