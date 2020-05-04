<?php

namespace App\Http\Controllers;

use App\Core\Infrastructure\Contracts\ZipCodeAutoCompleteInterface;
use App\Core\Infrastructure\Models\ZipCodeAutoCompleteResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class AutoCompleteByZipCode
 * @package App\Http\Controllers
 */
class AutoCompleteByZipCode extends Controller
{
    /**
     * @var ZipCodeAutoCompleteInterface
     */
    protected $contract;

    /**
     * AutoCompleteByZipCode constructor.
     * @param ZipCodeAutoCompleteInterface $zipCodeAutoComplete
     */
    public function __construct(ZipCodeAutoCompleteInterface $zipCodeAutoComplete)
    {
        $this->contract = $zipCodeAutoComplete;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'zip' => 'required|min:6',
            'street_number' => 'required|int'
        ]);

        Log::info('Querying PRO6PP', [
            'zip' => $request->input('zip'),
            'street_number' => $request->input('street_number')
        ]);

        /** @var ZipCodeAutoCompleteResult $result */
        $result = $this->contract->autoComplete($request->input('zip'), (int) $request->input('street_number'));
        if ($result->isSuccess()) {
            return response()->json([
                'zip_code' => $result->getZipCode(),
                'street' => $result->getStreet(),
                'city' => $result->getCity(),
                'province' => $result->getProvince(),
                'coordinates' => [
                    'lat' => $result->getLat(),
                    'lng' => $result->getLng()
                ]
            ]);
        }

        return response()->json([
            'message' => __('Address could not be found')
        ], 422);
    }
}
