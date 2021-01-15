<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ImageController;


Route::resource('/', ImageController::class)
    ->names('customer.image')
    ->except(['show', 'update', 'destroy']);
