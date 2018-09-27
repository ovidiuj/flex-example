<?php

namespace App\Service;


use App\DTO\ApiCityDTO;
use App\DTO\CityDTO;
use App\Entity\City;
use App\Entity\CityData;
use App\Entity\EntityInterface;
use JMS\Serializer\SerializerInterface;
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
     * ApiService constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param array $cities
     * @return array|\JMS\Serializer\scalar|object
     */
    public function createDataTransferObjects(array $cities)
    {
        $output = [];
        $temp = null;
        foreach ($cities as $data) {
            if(is_array($data) && isset($data['avg_temp'])) {
                $cityData = $data[0];
                $temp = $data['avg_temp'];
            } else {
                $cityData = $data;
            }

            if($cityData instanceof CityData) {
                $output[] = $this->createCityDataDataTransferObjects($cityData, $temp);
            }
        }
        $jsonData =  $this->serializer->serialize($output, 'json');
        return $this->serializer->deserialize($jsonData, 'array', 'json');
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