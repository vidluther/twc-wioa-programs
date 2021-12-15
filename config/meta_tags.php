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
        'default' => "A list of WIOA eligible training providers and programs in Texas",
        'separator' => '-',
        'max_length' => 255,
    ],

    /*
     * Meta description section
     */
    'description' => [
        'default' => 'A list of ETPs (eligible training providers and programs) for the Texas Workforce Commission (TWC)
        WIOA program',
        'max_length' => 255,
    ],


    /*
     * Meta keywords section
     */
    'keywords' => [
        'default' => 'welding, CDL, pipe fitter, electrical, plumber training in Texas',
        'max_length' => 255
    ],

    /*
     * Default packages
     *
     * Packages, that should be included everywhere
     */
    'packages' => [
        'OG'
        // 'jquery', 'bootstrap', ...
    ],

    'charset' => 'utf-8',
    'robots' => 'all',
    'viewport' => Viewport::RESPONSIVE,
    'csrf_token' => true,
];
