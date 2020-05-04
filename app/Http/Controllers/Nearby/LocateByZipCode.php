<?php

namespace App\Http\Controllers\Nearby;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class LocateByZipCode
 * @package App\Http\Controllers\Nearby
 */
class LocateByZipCode extends Controller
{
    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'zip' => 'required|min:6',
            'street_number' => 'required|int'
        ]);
    }
}
