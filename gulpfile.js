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
    .scripts('modernizr.js')
    .scripts([
      'jquery.js',
      'jquery-ui.js'
    ], './public/js/vendor.js')
    .version([
      'js/modernizr.js',
      'js/vendor.js',
      'css/app.css',
      'js/app.js'
    ]);
});
