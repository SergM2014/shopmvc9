const { mix } = require('laravel-mix');

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

//mix.js('resources/assets/js/app.js', 'public/js').version()
mix.js('resources/assets/js/index.js', 'public/js').version()
   .sass('resources/assets/sass/app.scss', 'public/css').version()
.sass('resources/assets/sass/admin.scss', 'public/css').version();

mix.js('resources/assets/js/app.js', 'public/js').version();
mix.js('resources/assets/js/auth.js', 'public/js').version();
mix.js('resources/assets/js/productView.js', 'public/js').version();
mix.js('resources/assets/js/adminProducts.js', 'public/js').version();

