<?php
namespace App\Core\Infrastructure;

use App\Core\Infrastructure\Contracts\ZipCodeAutoCompleteInterface;
use App\Core\Infrastructure\Contracts\ZipCodeAutoCompleteResultContract;
use App\Core\Infrastructure\Models\ZipCodeAutoCompleteResult;
use App\Exceptions\AutoCompleteException;
use GuzzleHttp\Client;

/**
 * Class Pro6ppZipCodeAutoComplete
 * @package App\Core\Infrastructure
 */
class Pro6ppZipCodeAutoComplete implements ZipCodeAutoCompleteInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $baseUri = 'https://api.pro6pp.nl/v1/';

    /**
     * The constructor of the system
     * Pro6ppZipCodeAutoComplete constructor.
     */
    public function __construct()
    {
        $this->client = (new Client([
            'base_uri' => $this->baseUri,
            'http_errors' => false
        ]));
    }

    /**
     * @param string $code
     * @param int $number
     * @param string|null $extension
     * @return ZipCodeAutoCompleteResultContract
     * @throws AutoCompleteException
     */
    public function autoComplete(string $code, int $number, string $extension = null): ZipCodeAutoCompleteResultContract
    {
        $response = $this->client->get('autocomplete', [
            'query' => [
                'nl_sixpp' => $code,
                'auth_key' => env('PRO6PP_API_KEY'),
                'streetnumber' => $number,
                'extension' => $extension
            ]
        ]);

        if ($response->getStatusCode() === 200) {
            $response = $response->getBody()->getContents();
            $response = json_decode($response, true, JSON_THROW_ON_ERROR);
            return (new ZipCodeAutoCompleteResult($response));
        }

        throw new AutoCompleteException('Failed to connect to PRO6PP');
    }
}
