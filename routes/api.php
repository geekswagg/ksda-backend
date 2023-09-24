<?php

use App\Http\Controllers\PrayercellsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('v1/prayercells', [PrayercellsController::class, 'index']) -> name('prayercells.index');
Route::get('v1/prayercells/{prayercell}', [PrayercellsController::class, 'show']) -> name('prayercells.show');
Route::post('v1/prayercells', [PrayercellsController::class, 'store']) -> name('prayercells.store');
Route::put('v1/prayercells/{prayercell}', [PrayercellsController::class, 'update']) -> name('prayercells.update');
Route::delete('v1/prayercells/{prayercell}', [PrayercellsController::class, 'destroy']) -> name('prayercells.destory');
