<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoHunterController;

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

/*
|--------------------------------------------------------------------------
| php artisan route:list
|--------------------------------------------------------------------------
*/
// GET: localhost:8000/api/tipo-hunter
// POST: localhost:8000/api/tipo-hunter
// GET: localhost:8000/api/tipo-hunter/{_id}
// PATCH: localhost:8000/api/tipo-hunter/{_id}
// DELETE: localhost:8000/api/tipo-hunter/{_id}

Route::apiResources([
    'tipo-hunter' => TipoHunterController::class,
]);
