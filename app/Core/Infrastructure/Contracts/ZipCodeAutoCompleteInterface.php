<?php
namespace App\Core\Infrastructure\Contracts;

/**
 * Interface ZipCodeAutoCompleteInterface
 * @package App\Core\Infrastructure
 */
interface ZipCodeAutoCompleteInterface
{
    /**
     * @param string $zipCode
     * @param int $streetNumber
     * @param null|string $extension
     * @return ZipCodeAutoCompleteResultContract
     */
    public function autoComplete(string $zipCode, int $streetNumber, string $extension = null) : ZipCodeAutoCompleteResultContract;
}
