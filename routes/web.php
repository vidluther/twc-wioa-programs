<?php
use App\Models\Program;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Show;
use App\Http\Livewire\About;

use App\Http\Controllers\Sitemap;
use App\Http\Controllers\PrivacyPolicyController;
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

Route::get('sitemap.xml',[Sitemap::class, 'index']);

//Route::match(['get','post'],'/', Dashboard::class);

Route::get('/', Dashboard::class);
Route::get('/about', About::class);


Route::get ('/show/{program_twist_id}', Show::class);

Route::get ('/details/{twc_program_id}', \App\Http\Livewire\Details::class)
    ->name('program-details');

Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])
    ->name('policy.show');



Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
