<?php

use App\Http\Controllers\FpdfReportController;
use Illuminate\Support\Facades\Route;
use JetBrains\PhpStorm\Pure;
use Mockery\Generator\StringManipulation\Pass\Pass;

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

Route::view('patient','patients.patient')->name('patient');

Route::apiResource('apiPatient','App\Http\Controllers\PatientController');

Route::get('report',[FpdfReportController::class,'report'])->name('report');
