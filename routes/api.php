<?php

use App\Http\Controllers\PrayercellsController;
use App\Http\Controllers\UserAuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CountryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| START OF PRAYERCELL API Routes
|--------------------------------------------------------------------------
*/
Route::get('v1/prayercells', [PrayercellsController::class, 'index']) -> name('prayercells.index');
Route::get('v1/prayercells/{prayercell}', [PrayercellsController::class, 'show']) -> name('prayercells.show');
Route::post('v1/prayercells', [PrayercellsController::class, 'store']) -> name('prayercells.store');
Route::put('v1/prayercells/{prayercell}', [PrayercellsController::class, 'update']) -> name('prayercells.update');
Route::delete('v1/prayercells/{prayercell}', [PrayercellsController::class, 'destroy']) -> name('prayercells.destory');
/*
|--------------------------------------------------------------------------
| END OF PRAYERCELL API Routes
|--------------------------------------------------------------------------
*/

Route::post('login', [UserAuthenticationController::class, 'login']);
Route::post('register', [UserAuthenticationController::class, 'register']);
Route::post('logout', [UserAuthenticationController::class, 'logout'])->middleware('auth:sanctum');

/*
|--------------------------------------------------------------------------
| START OF COUNTRY API Routes
|--------------------------------------------------------------------------
*/
Route::controller(CountryController::class)->group(function () {
    Route::get('show-countries/{country}', 'show');
    Route::post('add-countries', 'store');
    Route::get('view-countries', 'index');
    Route::delete('destroy-countries/{country}', 'destroy');
    Route::put('update-countries/{country}', 'update');
});
/*
|--------------------------------------------------------------------------
| END OF COUNTRY API Routes
|--------------------------------------------------------------------------
*/