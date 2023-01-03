const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix.js("./node_modules/flowbite/dist/flowbite.js", "public/js")
    .js('resources/js/app.js', 'public/js')
    .sass('resources/css/app.scss', 'public/css').options({
        postCss: [ tailwindcss('./tailwind.config.js') ],
    }).version();