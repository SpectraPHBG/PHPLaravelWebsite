<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');


Route::get('/rigs', [App\Http\Controllers\RigsController::class, 'index'])->name('rigs.index');
Route::post('/rigs', [App\Http\Controllers\RigsController::class, 'filtered'])->name('rigs.filtered');
Route::get('/rigs/{id}', [App\Http\Controllers\RigsController::class, 'show'])->name('rigs.show');
Route::get('/create-rig', [App\Http\Controllers\RigsController::class, 'create'])->name('rigs.create')->middleware('auth');
Route::post('/store-rig', [App\Http\Controllers\RigsController::class, 'store'])->name('rigs.store')->middleware('auth');
Route::get('/edit-rig/{id}', [App\Http\Controllers\RigsController::class, 'edit'])->name('rigs.edit')->middleware('auth');
Route::post('/update-rig', [App\Http\Controllers\RigsController::class, 'update'])->name('rigs.update')->middleware('auth');

Auth::routes();
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
Route::post('/account', [App\Http\Controllers\AccountController::class, 'changeInDetails'])->name('account.changeInDetails');
Route::delete('/account', [App\Http\Controllers\RigsController::class, 'destroyRig'])->name('rigs.delete');
