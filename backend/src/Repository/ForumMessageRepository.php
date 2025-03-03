<?php

namespace App\Repository;

use App\Entity\ForumMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ForumMessage>
 */
class ForumMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumMessage::class);
    }

    /* *
 * Moderates a forum message.
 *
 * @param int $messageId The ID of the message to moderate.
 * @return void
 */
public function moderateMessage(int $messageId): void
{
    $message = $this->find($messageId);
    if ($message) {
        // Perform moderation actions (e.g., update status, remove content)
        $message->setStatus('moderated');
        $this->_em->persist($message);
        $this->_em->flush();
    }
}

/* *
 * Finds forum messages by the specified message content.
 *
 * @param string $message The message content to search for.
 * @return ForumMessage[] An array of forum messages with the specified content.
 */
public function findByMessage(string $message): array
{
    return $this->createQueryBuilder('fm')
        ->andWhere('fm.message LIKE :message')
        ->setParameter('message', '%' . $message . '%')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds forum messages by the specified date.
 *
 * @param string $date The date to search for.
 * @return ForumMessage[] An array of forum messages created on the specified date.
 */
public function findByDate(string $date): array
{
    return $this->createQueryBuilder('fm')
        ->andWhere('fm.date = :date')
        ->setParameter('date', $date)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds forum messages created before the specified date.
 *
 * @param string $date The date to use as the upper bound.
 * @return ForumMessage[] An array of forum messages created before the specified date.
 */
public function findByDateBefore(string $date): array
{
    return $this->createQueryBuilder('fm')
        ->andWhere('fm.date < :date')
        ->setParameter('date', $date)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds forum messages created after the specified date.
 *
 * @param string $date The date to use as the lower bound.
 * @return ForumMessage[] An array of forum messages created after the specified date.
 */
public function findByDateAfter(string $date): array
{
    return $this->createQueryBuilder('fm')
        ->andWhere('fm.date > :date')
        ->setParameter('date', $date)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds forum messages by the specified discussion.
 *
 * @param int $discussionId The ID of the discussion to search for.
 * @return ForumMessage[] An array of forum messages in the specified discussion.
 */
public function findByDiscussion(int $discussionId): array
{
    return $this->createQueryBuilder('fm')
        ->andWhere('fm.discussionId = :discussionId')
        ->setParameter('discussionId', $discussionId)
        ->getQuery()
        ->getResult();
}


//    /**
//     * @return ForumMessage[] Returns an array of ForumMessage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ForumMessage
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
