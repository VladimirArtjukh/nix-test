<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ImageSaveFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'saveImage';
    }
}