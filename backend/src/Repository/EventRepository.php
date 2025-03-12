<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function updateEvent($id, $title, $description, $date, $address, $date_start, $date_end, $path_image, $shop, $city)
    {
        $event = $this->find($id);
        $event->setTitle($title);
        $event->setDescription($description);
        $event->setDate($date);
        $event->setAddress($address);
        $event->setDateStart($date_start);
        $event->setDateEnd($date_end);
        $event->setPathImage($path_image);
        $event->setShop($shop);
        $event->setCity($city);

        $this->_em->persist($event);
        $this->_em->flush();
    }

    public function deleteEvent($id)
    {
        $event = $this->find($id);

        $this->_em->remove($event);
        $this->_em->flush();
    }
    //    /**
    //     * @return Event[] Returns an array of Event objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Event
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
