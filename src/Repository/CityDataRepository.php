<?php

namespace App\Repository;

use App\Entity\CityData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CityData|null find($id, $lockMode = null, $lockVersion = null)
 * @method CityData|null findOneBy(array $criteria, array $orderBy = null)
 * @method CityData[]    findAll()
 * @method CityData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CityData::class);
    }

//    /**
//     * @return CityData[] Returns an array of CityData objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CityData
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
