var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
  mix
    .sass('app.scss')
    .browserify('app.js')
    .browserify('admin.js')
    .scripts('modernizr.js')
    .scripts([
      './node_modules/jquery/dist/jquery.min.js'
    ], './public/js/vendor.js')
    .version([
      'js/modernizr.js',
      'js/vendor.js',
      'js/admin.js',
      'css/app.css',
      'js/app.js'
    ])
    .copy('resources/assets/img', 'public/build/img');
});
