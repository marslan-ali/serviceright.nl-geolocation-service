<?php

namespace Tests\Unit;

use App\Core\Infrastructure\Contracts\ZipCodeAutoCompleteInterface;

/**
 * Class Pro6ppZipCodeAutoCompleteTest
 */
class Pro6ppZipCodeAutoCompleteTest extends TestCase
{
    /**
     * @var ZipCodeAutoCompleteInterface
     */
    protected $contract;

    /**
     * Setup method
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->contract = $this->app[ZipCodeAutoCompleteInterface::class];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSuccessResponse()
    {
        $this->json('GET', '/autocomplete-by-zip', [
            'zip' => '1333HW',
            'street_number' => 114
        ]);

        $this->seeJsonStructure([
            'zip_code', 'street', 'city', 'province', 'coordinates' => ['lat', 'lng']
        ]);

        $this->assertResponseStatus(200);
    }

    public function testFailedResponse()
    {
        $this->json('GET', '/autocomplete-by-zip', [
            'zip' => '1333HWL',
            'street_number' => 114
        ]);

        $this->seeJsonStructure(['message']);
        $this->assertResponseStatus(422);
    }
}
