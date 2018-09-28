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
    /**
     * CityDataRepository constructor.
     * @param RegistryInterface $registry
     *
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CityData::class);
    }


    /**
     * @param array $params
     * @return mixed
     */
    public function getData(array $params = [])
    {
        $queryBuilder = $this->getCityDataQuery($params);

        if(isset($params['sort']) && is_array($params['sort']) === true) {
            $queryBuilder->orderBy('cd.' . key($params['sort']) , current($params['sort']));
        } else {
            $queryBuilder->orderBy('cd.datetime', 'DESC')
                ->setMaxResults(7);
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function getAvgTemp(array $params = [])
    {
        $queryBuilder = $this->getCityDataQuery($params);
        $queryBuilder->select(['cd', 'AVG(cd.temp) as avg_temp']);

        if(isset($params['sort']) && is_array($params['sort']) === true) {
            $queryBuilder->orderBy('avg_temp' , current($params['sort']));
        } else {
            $queryBuilder->orderBy('cd.datetime', 'DESC')
                ->setMaxResults(7);
        }

        $queryBuilder->groupBy('cd.city');

        return $queryBuilder->getQuery()
            ->getResult();
    }


    /**
     * @param array $params
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getCityDataQuery($params = [])
    {
        $queryBuilder = $this->createQueryBuilder('cd')
            ->innerJoin('cd.city', 'c');

        if(isset($params['minDate']) && empty($params['minDate']) === false) {
            $queryBuilder->andWhere('cd.datetime >= :start_date')
                ->setParameter('start_date', $params['minDate']);
        }
        if(isset($params['maxDate']) && empty($params['maxDate']) === false) {
            $queryBuilder->andWhere('cd.datetime <= :end_date')
                ->setParameter('end_date', $params['maxDate']);
        }

        if(isset($params['first']) && empty($params['first']) === false) {
            $queryBuilder->setFirstResult((int) $params['first']);
        }

        if(isset($params['last']) && empty($params['last']) === false) {
            $queryBuilder->setMaxResults((int) $params['last']);
        }

        return $queryBuilder;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function getBestWeekendData(array $params = [])
    {
        $queryBuilder = $this->getCityDataQuery($params);
        $queryBuilder->select(['cd', 'AVG(cd.temp) as avg_temp']);

        $queryBuilder->andWhere('DAYOFWEEK(cd.datetime) = :sunday OR DAYOFWEEK(cd.datetime) = :saturday');
        $queryBuilder->setParameter('saturday', 7);
        $queryBuilder->setParameter('sunday', 1);

        if(isset($params['sort']) && is_array($params['sort']) === true) {
            $queryBuilder->orderBy('avg_temp', current($params['sort']));
        } else {
            $queryBuilder->orderBy('avg_temp', 'DESC')
                ->setMaxResults(7);
        }

        $queryBuilder->groupBy('cd.city');

        return $queryBuilder->getQuery()
            ->getResult();
    }

}
