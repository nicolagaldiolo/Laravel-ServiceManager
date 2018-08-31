let mix = require('laravel-mix');

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

/*
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
*/

mix.scripts(
    [
        'resources/assets/metronic/vendors/base/vendors.bundle.js',
        'resources/assets/metronic/demo/default/base/scripts.bundle.js',
        'resources/assets/metronic/vendors/custom/fullcalendar/fullcalendar.bundle.js',
        'resources/assets/metronic/vendors/custom/datatables/datatables.bundle.js',
        'resources/assets/metronic/demo/default/custom/components/base/toastr.js',
        'node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',
        'resources/assets/js/app.js',
    ], 'public/js/app.js')
    .sass('resources/assets/sass/app.scss', 'public/css');