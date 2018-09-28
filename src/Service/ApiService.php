<?php

namespace App\Service;


use App\DTO\ApiCityDTO;
use App\Entity\City;
use App\Entity\CityData;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Intl\Intl;

/**
 * Class ApiService
 * @package App\Service
 */
class ApiService
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var int
     */
    private $numberOfResultsPerPage = 5;

    /**
     * ApiService constructor.
     * @param SerializerInterface $serializer
     * @param ParameterBagInterface $params
     */
    public function __construct(SerializerInterface $serializer, ParameterBagInterface $params)
    {
        $this->serializer = $serializer;
        if($params->get('numberOfResultsPerPage')) {
            $this->numberOfResultsPerPage = $params->get('numberOfResultsPerPage');
        }
    }

    /**
     * @param array $entities
     * @return array|\JMS\Serializer\scalar|object
     */
    public function createDataTransferObjects(array $entities)
    {
        $output = [];
        foreach ($entities as $cityData) {
            if ($cityData instanceof CityData) {
                $output[] = $this->createCityDataDataTransferObjects($cityData);
            }
        }
        $jsonData = $this->serializer->serialize($output, 'json');
        return $this->serializer->deserialize($jsonData, 'array', 'json');
    }


    /**
     * @param array $entities
     * @return array|\JMS\Serializer\scalar|object
     */
    public function createAvgDataTransferObjects(array $entities)
    {
        $output = [];
        $temp = $cityData = null;
        foreach ($entities as $data) {
            if (is_array($data) && isset($data['avg_temp'])) {
                $cityData = $data[0];
                $temp = $data['avg_temp'];
            }

            if ($cityData instanceof CityData) {
                $output[] = $this->createCityDataDataTransferObjects($cityData, $temp);
            }
        }
        $jsonData = $this->serializer->serialize($output, 'json');
        return $this->serializer->deserialize($jsonData, 'array', 'json');
    }


    /**
     * @return int
     */
    public function getNumberOfResultsPerPage()
    {
        return $this->numberOfResultsPerPage;
    }

    /**
     * @param CityData $cityData
     * @param null $temp
     * @return ApiCityDTO
     */
    private function createCityDataDataTransferObjects(CityData $cityData, $temp = null)
    {
        $city = $cityData->getCity();
        return $this->createCityDto($city, $cityData, $temp);
    }

    /**
     * @param City $city
     * @param CityData $data
     * @param null $temp
     * @return ApiCityDTO
     */
    private function createCityDto(City $city, CityData $data, $temp = null)
    {
        $cityDto = new ApiCityDTO();
        $cityDto->setCity($city->getCityName());
        $cityDto->setCityId($city->getId());
        $cityDto->setCountry(Intl::getRegionBundle()->getCountryName($city->getCountryCode()));
        $cityDto->setTemperature($temp ? $temp : $data->getTemp());
        $cityDto->setDate($data->getDatetime());

        return $cityDto;
    }
}