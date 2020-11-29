<?php

namespace App\Repository;

use App\Entity\School;
use App\Entity\User;
use App\Entity\UserSchoolMembership;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserSchoolMembership|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSchoolMembership|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSchoolMembership[]    findAll()
 * @method UserSchoolMembership[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSchoolMembershipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSchoolMembership::class);
    }

    public function isMemberOf(int $schoolId, User $user): bool
    {
        $query = $this->createQueryBuilder('usm')
            ->andWhere('usm.user = :user')
            ->setParameter('user', $user)
            ->andWhere('school = :school');
    }

    // /**
    //  * @return UserSchoolMembership[] Returns an array of UserSchoolMembership objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserSchoolMembership
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
