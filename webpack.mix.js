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

/*mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin.js','public/js/admin.js')
    .js('public/pagebuilder/pagebuilder.js','public/pagebuilder/pagebuilder.min.js')
    .sass('resources/sass/app.scss', 'public/css/app.css');*/
    //.sass('resources/sass/_admin.scss','public/css/admin.css');

mix.js('public/pagebuilder/pagebuilder.js','public/pagebuilder/pagebuilder.min.js')

