<?php

namespace App\DTO;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class CityDTO
{
    /**
     * @var string
     * @Type("string")
     * @SerializedName("city_name")
     */
    private $cityName;

    /**
     * @var string
     * @Type("string")
     *
     */
    private $timezone;

    /**
     * @var string
     * @Type("string")
     * @SerializedName("country_code")
     */
    private $countryCode;

    /**
     * @var array
     * @Type("array<App\DTO\DataDTO>")
     *
     */
    private $data;

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param mixed $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }


}