<?php

namespace App\Providers;

use App\Core\Infrastructure\Contracts\ZipCodeAutoCompleteInterface;
use App\Core\Infrastructure\Pro6ppZipCodeAutoComplete;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ZipCodeAutoCompleteInterface::class, Pro6ppZipCodeAutoComplete::class);
    }
}
