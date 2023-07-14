<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HunterController;
use App\Http\Controllers\RecompensaController;

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

Route::controller(HunterController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/create-hunter', 'create')->name('create');
    Route::get('/view-hunter/{_id}', 'show')->name('show');
    Route::get('/update-hunter/{_id}', 'edit')->name('edit');
    Route::get('/trash-hunter', 'trashHunter')->name('trashHunter');
    Route::get('/restore-register-hunter/{_id}', 'restoreHunterTrash')->name('restoreHunterTrash');
    Route::get('/search-hunter', 'searchHunter')->name('searchHunter');
    Route::post('/create-hunter', 'store')->name('store');
    Route::patch('/update-hunter/{_id}', 'update')->name('update');
    Route::delete('/delete-hunter/{_id}', 'destroy')->name('destroy');
    Route::delete('/delete-register-hunter/{_id}', 'deleteHunterTrash')->name('deleteHunterTrash');
});

Route::controller(RecompensaController::class)->group(function() {
    Route::get('/reward', 'index')->name('index');
    Route::get('/create-reward', 'create')->name('create');
    Route::get('/view-reward/{_id}', 'show')->name('show');
    Route::get('/update-reward/{_id}', 'edit')->name('edit');
    Route::get('/trash-reward', 'trashReward')->name('trashReward');
    Route::get('/restore-register-reward/{_id}', 'restoreRewardTrash')->name('restoreRewardTrash');
    Route::get('/search-reward', 'searchReward')->name('searchReward');
    Route::post('/create-reward', 'store')->name('store');
    Route::patch('/update-reward/{_id}', 'update')->name('update');
    Route::delete('/delete-reward/{_id}', 'destroy')->name('destroy');
    Route::delete('/delete-register-reward/{_id}', 'deleteRewardTrash')->name('deleteRewardTrash');
});
