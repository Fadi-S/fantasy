let mix = require('laravel-mix');

mix.js('resources/assets/js/admin/app.js', 'public/js/admin')
    .sass('resources/assets/sass/admin/app.scss', 'public/css/admin')
    .js('resources/assets/js/user/app.js', 'public/js')
    .sass('resources/assets/sass/user/app.scss', 'public/css');
