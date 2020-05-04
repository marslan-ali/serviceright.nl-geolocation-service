<?php

namespace App\Core\Infrastructure\Contracts;

/**
 * Autocomplete the zip code
 *
 * Interface ZipCodeAutoCompleteResultContract
 * @package App\Core\Infrastructure\Contracts
 */
interface ZipCodeAutoCompleteResultContract
{
    /**
     * Determine if the result executed successfully
     * @return bool
     */
    public function isSuccess() : bool;

    /**
     * Retrieve the zip code
     * @return string
     */
    public function getZipCode() : string;

    /**
     * Retrieve the street name
     * @return string
     */
    public function getStreet() : string;

    /**
     * Retrieve the city name
     * @return string
     */
    public function getCity() : string;

    /**
     * Retrieve the province
     * @return string
     */
    public function getProvince() : string;

    /**
     * Retrieve the latitude
     * @return string
     */
    public function getLat() : string;

    /**
     * Retrieve the longtitude
     * @return string
     */
    public function getLng() : string;
}
