<?php

namespace App\Providers;

use App\Services\Image\Images;
use Illuminate\Support\ServiceProvider;

class ImageSaveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('saveImage',Images::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
