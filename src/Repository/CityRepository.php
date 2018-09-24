<?php

namespace App\Repository;

use App\DTO\CityDTO;
use App\DTO\DataDTO;
use App\Entity\City;
use App\Entity\CityData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, City::class);
    }

    public function create(CityDTO $cityDTO)
    {
        try {
            $cityName = $cityDTO->getCityName();
            $city = $this->findByName($cityName);
            if($cityName !== null && (empty($city) === true || !($city instanceof City))) {
                $city = new City();
                $city->setCityName($cityDTO->getCityName());
                $city->setCountryCode($cityDTO->getCountryCode());
                $city->setTimezone($cityDTO->getTimezone());
            }

            $data = $cityDTO->getData();
            if (empty($data) === false && is_array($data)) {
                foreach ($data as $dataDto) {
                    if ($dataDto instanceof DataDTO) {
                        $dataObject = new CityData();
                        $dataObject->setDatetime($dataDto->getDatetime());
                        $dataObject->setMaxTemp($dataDto->getMaxTemp());
                        $dataObject->setMinTemp($dataDto->getMinTemp());
                        $dataObject->setTemp($dataDto->getTemp());
                        $city->addData($dataObject);
                    }
                }
            }


            if($city instanceof City) {
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $this->getEntityManager()->persist($city);

                // actually executes the queries (i.e. the INSERT query)
                $this->getEntityManager()->flush();
            }

        } catch (Exception $exception) {
            //do nothing because of  duplicate entry
        }
    }

    /**
     * @param $value
     * @return City
     */

    public function findByName($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.city_name = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?City
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
