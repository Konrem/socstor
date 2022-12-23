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


mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .js('resources/js/cke-config.js', 'public/js')
    .js('resources/js/ckeditor-init.js', 'public/js')
    .js('resources/js/single-img-preview.js', 'public/js')
    .js('resources/js/main-block.js', 'public/js')
    .js('resources/js/news-carusel.js', 'public/js')
    .js('resources/js/partners-carusel.js', 'public/js')
    .js('resources/js/input-validation.js', 'public/js')

    // jquery
    .js('resources/js/jquery-3.4.1.min.js', 'public/js')
    .js('resources/js/jquery-migrate-1.4.1.min.js', 'public/js')


    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/media.scss', 'public/css')
    .sass('resources/sass/user.scss', 'public/css');

mix.copy('node_modules/croppie/croppie.css', 'public/css/croppie.css');
mix.copy('node_modules/croppie/croppie.min.js', 'public/js/croppie.min.js');
mix.copy('resources/js/all.min.js', 'public/js/all.min.js');

mix.copy('node_modules/slick-carousel/slick/slick.min.js', 'public/js');
mix.copy('node_modules/slick-carousel/slick/slick.css', 'public/css');
mix.copy('node_modules/slick-carousel/slick/slick-theme.css', 'public/css');
mix.copy('node_modules/slick-carousel/slick/ajax-loader.gif', 'public/css');
mix.copy('node_modules/slick-carousel/slick/fonts/slick.woff', 'public/css/fonts');
mix.copy('node_modules/slick-carousel/slick/fonts/slick.ttf', 'public/css/fonts');
