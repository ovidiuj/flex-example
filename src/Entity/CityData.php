<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityDataRepository")
 */
class CityData implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $max_temp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $datetime;

    /**
     * @ORM\Column(type="float")
     */
    private $temp;

    /**
     * @ORM\Column(type="float")
     */
    private $min_temp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\City", inversedBy="data")
     */
    private $city;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxTemp(): ?float
    {
        return $this->max_temp;
    }

    public function setMaxTemp(float $max_temp): self
    {
        $this->max_temp = $max_temp;

        return $this;
    }

    public function getDatetime(): ?string
    {
        return $this->datetime;
    }

    public function setDatetime(string $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(float $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getMinTemp(): ?float
    {
        return $this->min_temp;
    }

    public function setMinTemp(float $min_temp): self
    {
        $this->min_temp = $min_temp;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }
}
