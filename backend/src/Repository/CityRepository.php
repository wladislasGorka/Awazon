<?php

namespace App\Repository;

use App\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<City>
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    /**
     * Trouver toutes les villes triées par nom.
     *
     * @return City[] Returns an array of City objects
     */
    public function findAllCities(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.city_name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver une ville par son nom exact.
     *
     * @param string $cityName Le nom exact de la ville
     * @return City|null Returns a City object or null
     */
    public function findOneByCityName(string $cityName): ?City
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.city_name = :cityName')
            ->setParameter('cityName', $cityName)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Rechercher les villes dont le nom contient une chaîne spécifique (recherche partielle).
     *
     * @param string $searchTerm Le terme à rechercher dans le nom de la ville
     * @return City[] Returns an array of City objects
     */
    public function findByCityNameLike(string $searchTerm): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.city_name LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->orderBy('c.city_name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver les villes par code postal.
     *
     * @param int $code Le code postal de la ville
     * @return City[] Returns an array of City objects
     */
    public function findByCode(int $code): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.code = :code')
            ->setParameter('code', $code)
            ->orderBy('c.city_name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouver les villes associées à un certain nombre minimum de membres.
     *
     * @param int $minMembers Le nombre minimum de membres associés
     * @return City[] Returns an array of City objects
     */
    public function findCitiesWithMinMembers(int $minMembers): array
    {
        return $this->createQueryBuilder('c')
            ->join('c.members', 'm') // Jointure avec les membres
            ->groupBy('c.id')
            ->having('COUNT(m.id) >= :minMembers')
            ->setParameter('minMembers', $minMembers)
            ->orderBy('c.city_name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
