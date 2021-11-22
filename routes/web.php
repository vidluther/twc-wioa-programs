<?php

use App\Models\Post;
use App\Models\Provider;
use App\Models\ProviderType;
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

Route::get('/providers', function () {
    return view('providers/all',
        [
            'providers' => Provider::with('provider_type')->get()
        ]);


});

Route::get('providers/{provider:twc_id}', function (Provider $provider) {
    return view('providers/detail', [
        'provider' => $provider
    ]);
});

Route::get('providertypes/{providertype:slug}', function (ProviderType $providertype) {

    return view('providers/bytype',
        [
            'providertypename' => $providertype->name,
            'providers' => $providertype->providers
        ]);


});

Route::get('/programs', function () {
    return view('programs/all',
        [
            'programs' => Program::all()
        ]);


});

Route::get('/campus', function () {


});

Route::get('/posts', function () {

    return view('posts',
    [
        'posts' => Post::all()
    ]);

});

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});

Route::get('/', function () {
    return view('welcome');
});
