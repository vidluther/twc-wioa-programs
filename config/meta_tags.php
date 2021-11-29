<?php

use Butschster\Head\MetaTags\Viewport;

return [
    /*
     * Meta title section
     */
//    'title' => [
//        'default' => env('APP_NAME'),
//        'separator' => '-',
//        'max_length' => 255,
//    ],

    'title' => [
        'default' => "TexasWFC Homepage",
        'separator' => '-',
        'max_length' => 255,
    ],

    /*
     * Meta description section
     */
    'description' => [
        'default' => 'A list of programs and providers that the Texas Workforce Commission (TWC) will work with,
         to help you retrain or learn a new skill. ',
        'max_length' => 255,
    ],


    /*
     * Meta keywords section
     */
    'keywords' => [
        'default' => 'texas workforce comission, welding classes tx, CDL Training Texas',
        'max_length' => 255
    ],

    /*
     * Default packages
     *
     * Packages, that should be included everywhere
     */
    'packages' => [
        // 'jquery', 'bootstrap', ...
    ],

    'charset' => 'utf-8',
    'robots' => null,
    'viewport' => Viewport::RESPONSIVE,
    'csrf_token' => true,
];
