<?php

namespace App\DTO;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class DataDTO
{
    /**
     * @var float
     * @Type("float")
     * @SerializedName("max_temp")
     */
    private $maxTemp;

    /**
     * @var string
     * @Type("string")
     *
     */
    private $datetime;

    /**
     * @var float
     * @Type("float")
     * @SerializedName("temp")
     */
    private $temp;

    /**
     * @var float
     * @Type("float")
     * @SerializedName("min_temp")
     */
    private $minTemp;

    /**
     * @return mixed
     */
    public function getMaxTemp()
    {
        return $this->maxTemp;
    }

    /**
     * @param mixed $maxTemp
     */
    public function setMaxTemp($maxTemp)
    {
        $this->maxTemp = $maxTemp;
    }

    /**
     * @return mixed
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * @param mixed $datetime
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return mixed
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param mixed $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return mixed
     */
    public function getMinTemp()
    {
        return $this->minTemp;
    }

    /**
     * @param mixed $minTemp
     */
    public function setMinTemp($minTemp)
    {
        $this->minTemp = $minTemp;
    }



}