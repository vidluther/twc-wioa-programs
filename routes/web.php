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

//Route::get('/sandbox', function () {
//    return view('sandbox');
//});



Route::get( '/', [\App\Http\Controllers\ProgramController::class, 'dashboard']);
Route::get( '/about', function () {
    return view('about', [
    ]);
});

Route::get( '/dashboard', [\App\Http\Livewire\Dashboard::class, 'render']);

Route::get ('/show/{program_twist_id}',
                            [
                                \App\Http\Livewire\Show::class, 'render'
                            ]);

Route::get( '/programs', [\App\Http\Controllers\ProgramController::class, 'index']);


// Route::get( '/listing', [\App\Http\Livewire\Listing::class, 'programs']);

// Route::get( '/listing', [\App\Http\Livewire\Listing::class, 'render']);

// Route::get( '/sandbox', [\App\Http\Livewire\HelloWorld::class, 'render']);
