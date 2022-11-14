<?php

use App\Http\Controllers\Api\V1\ApartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::prefix('apartments')->name('apartments.')->group(function(){
        Route::get('sale', [ApartmentController::class, 'sale'])->name('sale');
        Route::get('rent', [ApartmentController::class, 'rent'])->name('rent');

        Route::prefix('filtered')->name('filtered.')->group(function(){
            Route::get('sale', [ApartmentController::class, 'saleFiltered'])->name('sale');
            Route::get('rent', [ApartmentController::class, 'rentFiltered'])->name('rent');
        });

        Route::get('show/{apartment}', [ApartmentController::class, 'show'])->name('show');
    });
});
