<?php

use App\Http\Controllers\Client\Blog\ApartmentController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\CreateLeadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::name('client.')->group(function(){
    // Route::get('/', [ApartmentController::class, 'test'])->name('main');
    Route::get('/', [HomeController::class, 'main'])->name('main');
    Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');

    Route::post('lead.add', CreateLeadController::class)->name('lead.add');
});
