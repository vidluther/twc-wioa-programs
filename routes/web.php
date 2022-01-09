<?php
use App\Models\Program;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
#use App\Http\Livewire\Show;
use App\Http\Livewire\About;

use App\Http\Controllers\Sitemap;
use App\Http\Controllers\Redirector;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\cityIndex;

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
Route::get('/about', About::class)->name('about');

Route::get('/cities', [cityIndex::class,'listCities'])
    ->name('list-of-cities');

Route::get('sitemap.xml',[Sitemap::class, 'index']);


Route::get('/show/{program_twist_id}', [Redirector::class, 'RedirectShow']);
Route::get ('/details/{twc_program_id}', [Redirector::class, 'RedirectDetails'])
    ->name('old-program-details');

Route::get('/in/{city}/', [cityIndex::class,'listByCity'])
    ->name('list-by-city');

Route::get ('/{slug}', \App\Http\Livewire\Details::class)
    ->name('program-details');




Route::get('/', Dashboard::class);



//Route::get('/{city}', [cityIndex::class, 'listByCity']);





Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])
    ->name('policy.show');




Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
