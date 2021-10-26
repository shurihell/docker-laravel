const mix = require('laravel-mix');
const distDir = 'public/assets/';
const assetsDir = 'resources/';
const nodeDir = 'node_modules/'

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



mix
    .copy(assetsDir + 'css/app.css', distDir + 'css/')
    .copy(assetsDir + 'css/vender.css', distDir + 'css/')
    .combine([
        nodeDir + 'bootstrap/dist/css/bootstrap.css',
        // nodeDir + 'bootstrap/dist/css/bootstrap-grid.css',
        // nodeDir + 'bootstrap/dist/css/bootstrap-reboot.css',
        // nodeDir + 'bootstrap/dist/css/bootstrap-utilities.css',
    ], distDir + 'css/web.css')
    .combine([
        assetsDir + 'js/app.js',
        nodeDir + 'bootstrap/dist/js/bootstrap.bundle.js'
    ], distDir + 'js/web.js')


;
