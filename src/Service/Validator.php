<?php


namespace App\Service;

/**
 * Class Validator
 * @package App\Service
 */
class Validator
{
    /**
     * @param $date
     * @param string $format
     * @return bool
     */
    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}