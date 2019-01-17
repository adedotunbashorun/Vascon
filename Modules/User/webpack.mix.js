const { mix } = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/user.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'css/user.css');

if (mix.inProduction()) {
    mix.version();
}

// let mix = require('laravel-mix');


// /* Allow multiple Laravel Mix applications*/
// require('laravel-mix-merge-manifest');
// mix.mergeManifest();
// /*----------------------------------------*/

// mix.js('resources/assets/js/app.js', 'public/js')
//     .sass('resources/assets/sass/app.scss', 'public/css');