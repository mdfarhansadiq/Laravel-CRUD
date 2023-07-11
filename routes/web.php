<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\home\HomeController;
use App\Models\HomeModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'homeFunction'])->name('HomePage');
Route::post('/home/create', [HomeController::class, 'homeFunctionCreate']);
Route::get('/home-data', [HomeController::class, 'homeFunctionAllData']);
Route::get('/home-data/edit/{id}', [HomeController::class, 'homeFunctionEdit']);
Route::post('/home-data/update/{id}', [HomeController::class, 'homeFunctionUpdate']);
Route::get('/home-data/delete/{id}', [HomeController::class, 'homeFunctionDelete']);

Route::get('/registration', [HomeController::class, 'customRegistrationView']);
Route::post('/registration/create', [HomeController::class, 'customRegistrationCreate']);

Route::get('/login', [HomeController::class, 'customLoginView']);
Route::post('/login/create', [HomeController::class, 'customLoginCreate']);
Route::post('/logout', [HomeController::class, 'customLogout']);
