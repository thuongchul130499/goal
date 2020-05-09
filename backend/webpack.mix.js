const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts([
    'node_modules/sweetalert/dist/sweetalert.min.js',
    'node_modules/nouislider/distribute/nouislider.min.js',
    ], 'public/js/plugin.js')
    .styles([
        'node_modules/nouislider/distribute/nouislider.min.css',
    ], 'public/css/public.css')
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/main.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/images', 'public/images')
    .copyDirectory('resources/template', 'public/template');