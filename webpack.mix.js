let mix = require('laravel-mix');
const WebpackShellPlugin = require('webpack-shell-plugin');

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

// Add shell command plugin configured to create JavaScript language file
mix.webpackConfig({
    plugins:
        [
            new WebpackShellPlugin({onBuildStart:['php artisan lang:js --quiet'], onBuildEnd:[]})
        ]
});


// i don't use mix.scripts() because has some problems with `` characters.

mix.scripts(
    [
        'metronic_v5.5.5/dist/default/assets/vendors/base/vendors.bundle.js',
        'metronic_v5.5.5/dist/default/assets/demo/default/base/scripts.bundle.js',
        'metronic_v5.5.5/dist/default/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js',
        'metronic_v5.5.5/dist/default/assets/vendors/custom/datatables/datatables.bundle.js',
        'metronic_v5.5.5/dist/default/assets/demo/default/custom/components/base/toastr.js',
        'node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js',
    ], 'public/js/vendors.js')
    .babel(
        [
            'resources/messages/messages.js',
            'resources/js/app.js',
        ], 'public/js/app.js')
    .sass('resources/sass/app.scss', 'public/css');
