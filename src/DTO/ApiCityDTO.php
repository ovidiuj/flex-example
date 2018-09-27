<?php

namespace App\DTO;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class ApiCityDTO
{
    /**
     * @var string
     * @Type("string")
     * @SerializedName("city")
     */
    private $city;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("country")
     */
    private $country;

    /**
     * @var float
     * @Type("float")
     * @SerializedName("temperature")
     */
    private $temperature;

    /**
     * @var string
     * @Type("string")
     */
    private $date;

    /**
     * @var integer
     * @Type("int")
     */
    private $cityId;

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return float
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param float $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getCityId()
    {
        return $this->cityId;
    }

    /**
     * @param int $cityId
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;
    }


}