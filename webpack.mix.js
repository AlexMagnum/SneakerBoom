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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/bootstrap.js', 'public/js')
    .js('resources/js/bootstrap.min.js', 'public/js')
    .js('resources/js/imagezoom.js', 'public/js')
    .js('resources/js/jquery.flexslider.js', 'public/js')
    .js( 'resources/js/jquery-2.1.4.min.js', 'public/js')
    .js(  'resources/js/simpleCart.min.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/bootstrap.min.css', 'public/css')
    .postCss('resources/css/flexslider.css', 'public/css')
    .postCss( 'resources/css/form.css', 'public/css')
    .postCss( 'resources/css/jquery-ui.css', 'public/css')
    .postCss(  'resources/css/style.css', 'public/css');
