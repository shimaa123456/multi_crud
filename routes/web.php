<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\OurserviceController;
Route::resource('ourservices', OurserviceController::class);

use App\Http\Controllers\MainbannerController;
Route::resource('mainbanner', MainbannerController::class);

use App\Http\Controllers\FeatureController;
// use App\Models\Feature;
Route::resource('features', FeatureController::class);

use App\Http\Controllers\DashminController;

Route::get('/Dashmin', [DashminController::class, 'showPage'])->name('Dashmin.index');


Route::get('/', function () {

 return view('welcome');
});