const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

/*
 | https://laravel.com/docs/8.x/mix#running-mix
 | When running npm run, if things explode. it's because of a bug in newest node..
 | https://www.bswen.com/2021/11/reactjs-ERR_OSSL_EVP_UNSUPPORTED_error_solution.html
 | export NODE_OPTIONS=--openssl-legacy-provider
 */

mix.js('resources/js/app.js', 'public/js')

    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);

// if (mix.inProduction()) {
//     mix.version();
// }
