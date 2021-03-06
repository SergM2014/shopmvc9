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


mix.js('resources/assets/js/components/bootstrap-sass.js', 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css').version();


mix.js('resources/assets/js/index.js', 'public/js').version();
mix.js('resources/assets/js/app.js', 'public/js').version();
mix.js('resources/assets/js/productView.js', 'public/js').version();



mix.js('resources/assets/js/admin/products.js', 'public/js/admin').version();
mix.js('resources/assets/js/admin/createProduct.js', 'public/js/admin').version();
mix.js('resources/assets/js/admin/categories.js', 'public/js/admin').version();

mix.js('resources/assets/js/admin/auth.js', 'public/js/admin');

mix.js('resources/assets/js/admin/comments.js', 'public/js/admin').version();
mix.js('resources/assets/js/admin/updateComment.js', 'public/js/admin').version();
mix.js('resources/assets/js/admin/manufacturers.js', 'public/js/admin').version();
mix.js('resources/assets/js/admin/users.js', 'public/js/admin').version();


mix.sass('resources/assets/sass/admin.scss', 'public/css').version();