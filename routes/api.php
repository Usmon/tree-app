<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TreeController;

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

Route::group(['name' => 'tree', 'prefix' => 'tree', 'as' => 'tree.'], function() {
    Route::get('list', [TreeController::class, 'list'])->name('list');
    Route::post('create', [TreeController::class, 'create'])->name('create');
    Route::put('update', [TreeController::class, 'update'])->name('update');
    Route::delete('delete', [TreeController::class, 'delete'])->name('delete');
    Route::patch('move', [TreeController::class, 'move'])->name('move');
});
