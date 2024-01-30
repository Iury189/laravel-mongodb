<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HunterController,RecompensaController,RecompensadoController};

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
    Route::get('/', 'index')->name('indexHunter');
    Route::get('/create-hunter', 'create')->name('createHunter');
    Route::get('/view-hunter/{_id}', 'show')->name('showHunter');
    Route::get('/update-hunter/{_id}', 'edit')->name('editHUnter');
    Route::get('/trash-hunter', 'trashHunter')->name('trashHunter');
    Route::get('/restore-register-hunter/{_id}', 'restoreHunterTrash')->name('restoreHunterTrash');
    Route::get('/search-hunter', 'searchHunter')->name('searchHunter');
    Route::get('/search-hunter-trash', 'searchHunterTrash')->name('searchHunterTrash');
    Route::post('/create-hunter', 'store')->name('storeHunter');
    Route::patch('/update-hunter/{_id}', 'update')->name('updateHunter');
    Route::delete('/delete-hunter/{_id}', 'destroy')->name('destroyHunter');
    Route::delete('/delete-register-hunter/{_id}', 'deleteHunterTrash')->name('deleteHunterTrash');
});

Route::controller(RecompensaController::class)->group(function() {
    Route::get('/reward', 'index')->name('indexReward');
    Route::get('/create-reward', 'create')->name('createReward');
    Route::get('/view-reward/{_id}', 'show')->name('showReward');
    Route::get('/update-reward/{_id}', 'edit')->name('editReward');
    Route::get('/trash-reward', 'trashReward')->name('trashReward');
    Route::get('/restore-register-reward/{_id}', 'restoreRewardTrash')->name('restoreRewardTrash');
    Route::get('/search-reward', 'searchReward')->name('searchReward');
    Route::get('/search-reward-trash', 'searchRewardTrash')->name('searchRewardTrash');
    Route::post('/create-reward', 'store')->name('storeReward');
    Route::patch('/update-reward/{_id}', 'update')->name('updateReward');
    Route::delete('/delete-reward/{_id}', 'destroy')->name('destroyReward');
    Route::delete('/delete-register-reward/{_id}', 'deleteRewardTrash')->name('deleteRewardTrash');
});

Route::controller(RecompensadoController::class)->group(function() {
    Route::get('/rewarded', 'index')->name('indexRewarded');
    Route::get('/create-rewarded', 'create')->name('createRewarded');
    Route::get('/view-rewarded/{_id}', 'show')->name('showRewarded');
    Route::get('/update-rewarded/{_id}', 'edit')->name('editRewarded');
    Route::get('/trash-rewarded', 'trashRewarded')->name('trashRewarded');
    Route::get('/restore-register-rewarded/{_id}', 'restoreRewardedTrash')->name('restoreRewardedTrash');
    Route::get('/search-rewarded', 'searchRewarded')->name('searchRewarded');
    Route::get('/search-rewarded-trash', 'searchRewardedTrash')->name('searchRewardedTrash');
    Route::post('/create-rewarded', 'store')->name('storeRewarded');
    Route::patch('/update-rewarded/{_id}', 'update')->name('updateRewarded');
    Route::delete('/delete-rewarded/{_id}', 'destroy')->name('destroyRewarded');
    Route::delete('/delete-register-rewarded/{_id}', 'deleteRewardedTrash')->name('deleteRewardedTrash');
});
