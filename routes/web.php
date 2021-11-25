<?php

use App\Models\Program;
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

//Route::get('/programs', function () {
//    return view('programs/all',
//        [
//            'programs' => Program::all()
//        ]);
//
//
//});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get( '/', [\App\Http\Controllers\ProgramController::class, 'dashboard']);

Route::get( '/programs', [\App\Http\Controllers\ProgramController::class, 'index']);
