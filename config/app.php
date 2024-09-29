<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'display_analytics_js' => env('DISPLAY_ANALYTICS_JS', false),

    'analytics_domain' => env('DISPLAY_ANALYTICS_DOMAIN', 'example.com'),

    'google_analytics_id' => env('GOOGLE_ANALYTICS_ID', 'G-XXXXXX'),

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\MetaTagsServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

];
