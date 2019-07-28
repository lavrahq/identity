const mix = require('laravel-mix');
require('laravel-mix-tailwind');

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

mix
    .setPublicPath('./public')
    .js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css')
    .copyDirectory('resources/img', 'public/img')
    .tailwind()
    .version()
