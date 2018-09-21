<?php
namespace src\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Class Data
 * @package src\Entity
 * @Entity(repositoryClass="DataRepository") @Table(name="data")
 */
class Data
{
    /**
     * @var int
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;

    /**
     * @Column(type="float")
     * @var double
     */
    private $maxTemp;

    /**
     * @Column(type="datetime")
     * @var DateTime
     */
    private $dateTime;

    /**
     * @Column(type="float")
     * @var double
     */
    private $temp;

    /**
     * @Column(type="float")
     * @var double
     */
    private $minTemp;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getMaxTemp()
    {
        return $this->maxTemp;
    }

    /**
     * @param float $maxTemp
     */
    public function setMaxTemp($maxTemp)
    {
        $this->maxTemp = $maxTemp;
    }

    /**
     * @return DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param DateTime $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return float
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param float $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return float
     */
    public function getMinTemp()
    {
        return $this->minTemp;
    }

    /**
     * @param float $minTemp
     */
    public function setMinTemp($minTemp)
    {
        $this->minTemp = $minTemp;
    }

    /**
     * @return ArrayCollection
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param ArrayCollection $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

}