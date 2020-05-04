<?php
namespace App\Core\Infrastructure\Models;

use App\Core\Infrastructure\Contracts\ZipCodeAutoCompleteResultContract;
use Log;

/**
 * Class ZipCodeAutoCompleteResultContract
 * @package App\Core\Infrastructure\Models
 */
class ZipCodeAutoCompleteResult implements ZipCodeAutoCompleteResultContract
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * ZipCodeAutoCompleteResult constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        if(isset($this->attributes['results']) && count($this->attributes['results']) > 1) {
            Log::warn('Retrieved more then 1 result', ['result' => $this->attributes]);
        }
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return (bool) ($this->attributes['status'] === 'ok');
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return current($this->attributes['results'])['nl_sixpp'];
    }

    public function getStreet(): string
    {
        return current($this->attributes['results'])['street'];
    }

    public function getCity(): string
    {
        return current($this->attributes['results'])['city'];
    }

    public function getProvince(): string
    {
        return current($this->attributes['results'])['province'];
    }

    public function getLat(): string
    {
        return current($this->attributes['results'])['lat'];
    }

    public function getLng(): string
    {
        return current($this->attributes['results'])['lng'];
    }
}
