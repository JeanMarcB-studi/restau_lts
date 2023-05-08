<?php

namespace App\Repository;

use App\Entity\OpenHour; 
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OpenHour>
 *
 * @method OpenHour|null find($id, $lockMode = null, $lockVersion = null)
 * @method OpenHour|null findOneBy(array $criteria, array $orderBy = null)
 * @method OpenHour[]    findAll()
 * @method OpenHour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpenHourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpenHour::class);
    }

    public function save(OpenHour $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OpenHour $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // public function getFullWeek(): array
    // {
    //     $conn = $this->getEntityManager()->getConnection();
    
    //     $sql = '
    //         SELECT * 
    //         FROM meal AS m
    //         LEFT JOIN category AS c ON category_id = c.id 
    //         ORDER BY c.range_num ASC, c.category_name ASC, c.sub_category ASC, m.meal_name ASC
    //         ';
    //     $stmt = $conn->prepare($sql);
    //     $resultSet = $stmt->executeQuery();
    
    //     // returns an array of arrays (i.e. a raw data set)
    //     return $resultSet->fetchAllAssociative();
    // }
        
    

//    /**
//     * @return OpenHour[] Returns an array of OpenHour objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OpenHour
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
