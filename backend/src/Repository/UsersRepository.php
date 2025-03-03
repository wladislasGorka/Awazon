<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Users>
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }


    /* *
 * Retrieves a user by email and password.
 *
 * @param string $email The email of the user.
 * @param string $password The password of the user.
 * @return User|null The user with the specified email and password, or null if not found.
 */
public function getUserByMailAndPassword(string $email, string $password): ?User
{
    return $this->createQueryBuilder('u')
        ->andWhere('u.email = :email')
        ->andWhere('u.password = :password')
        ->setParameter('email', $email)
        ->setParameter('password', $password)
        ->getQuery()
        ->getOneOrNullResult();
}

/* *
 * Updates a user's information.
 *
 * @param int $userId The ID of the user to update.
 * @param array $data An associative array of fields to update.
 * @return void
 */
public function updateUser(int $userId, array $data): void
{
    $user = $this->find($userId);
    if ($user) {
        foreach ($data as $field => $value) {
            $method = 'set' . ucfirst($field);
            if (method_exists($user, $method)) {
                $user->$method($value);
            }
        }
        $this->_em->persist($user);
        $this->_em->flush();
    }
}

/* *
 * Finds all users.
 *
 * @return User[] An array of all users.
 */
public function findAll(): array
{
    return $this->createQueryBuilder('u')
        ->getQuery()
        ->getResult();
}

/* *
 * Finds users by the specified name.
 *
 * @param string $name The name to search for.
 * @return User[] An array of users with the specified name.
 */
public function findByName(string $name): array
{
    return $this->createQueryBuilder('u')
        ->andWhere('u.name = :name')
        ->setParameter('name', $name)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds users by the specified role.
 *
 * @param string $role The role to search for.
 * @return User[] An array of users with the specified role.
 */
public function findByRole(string $role): array
{
    return $this->createQueryBuilder('u')
        ->andWhere('u.role = :role')
        ->setParameter('role', $role)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds users by the specified status.
 *
 * @param string $status The status to search for.
 * @return User[] An array of users with the specified status.
 */
public function findByStatut(string $status): array
{
    return $this->createQueryBuilder('u')
        ->andWhere('u.status = :status')
        ->setParameter('status', $status)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds users by the specified registration date.
 *
 * @param string $registerDate The registration date to search for.
 * @return User[] An array of users registered on the specified date.
 */
public function findByRegisterDate(string $registerDate): array
{
    return $this->createQueryBuilder('u')
        ->andWhere('u.registerDate = :registerDate')
        ->setParameter('registerDate', $registerDate)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds users by their last login date.
 *
 * @param string $lastLoginDate The last login date to search for.
 * @return User[] An array of users who last logged in on the specified date.
 */
public function findByLastLogin(string $lastLoginDate): array
{
    return $this->createQueryBuilder('u')
        ->andWhere('u.lastLoginDate = :lastLoginDate')
        ->setParameter('lastLoginDate', $lastLoginDate)
        ->getQuery()
        ->getResult();
}

/* *
 * Finds users by the specified email.
 *
 * @param string $email The email to search for.
 * @return User|null The user with the specified email, or null if not found.
 */
public function findByMail(string $email): ?User
{
    return $this->createQueryBuilder('u')
        ->andWhere('u.email = :email')
        ->setParameter('email', $email)
        ->getQuery()
        ->getOneOrNullResult();
}

//    /**
//     * @return Users[] Returns an array of Users objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Users
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
