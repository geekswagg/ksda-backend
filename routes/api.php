<?php

use App\Http\Controllers\PrayercellsController;
use App\Http\Controllers\UserAuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\FolderController;
use App\Http\Controllers\API\StatusController;

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
/*
|--------------------------------------------------------------------------
| START OF DEPARTMENT API Routes
|--------------------------------------------------------------------------
*/
Route::controller(DepartmentController::class)->group(function () {
    Route::get('show-departments/{department}', 'show');
    Route::post('add-departments', 'store');
    Route::get('view-departments', 'index');
    Route::delete('destroy-departments/{department}', 'destroy');
    Route::put('update-departments/{department}', 'update');
});
/*
|--------------------------------------------------------------------------
| END OF DEPARTMENT API Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| START OF FOLDER API Routes
|--------------------------------------------------------------------------
*/
Route::controller(FolderController::class)->group(function () {
    Route::get('show-folders/{folder}', 'show');
    Route::post('add-folders', 'store');
    Route::get('view-folders', 'index');
    Route::delete('destroy-folders/{folder}', 'destroy');
    Route::put('update-folders/{folder}', 'update');
});
/*
|--------------------------------------------------------------------------
| END OF FOLDER API Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| START OF STATUS API Routes
|--------------------------------------------------------------------------
*/
Route::controller(StatusController::class)->group(function () {
    Route::get('show-statuses/{status}', 'show');
    Route::post('add-statuses', 'store');
    Route::get('view-statuses', 'index');
    Route::delete('destroy-statuses/{status}', 'destroy');
    Route::put('update-statuses/{status}', 'update');
});
/*
|--------------------------------------------------------------------------
| END OF STATUS API Routes
|--------------------------------------------------------------------------
*/