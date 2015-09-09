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
 var bowerDir = './bower_components/';
 
var lessPaths = [
    bowerDir + "bootstrap/less",
    bowerDir + "font-awesome/less"
];

elixir(function(mix) {
    mix.less('app.less', 'public/css', { paths: lessPaths })
        .scripts([
            'jquery/dist/jquery.min.js',
            'bootstrap/dist/js/bootstrap.min.js'
            ], 'public/js/vendor.js', bowerDir)
        .copy('resources/assets/js/app.js', 'public/js/app.js')
        .copy(bowerDir + 'font-awesome/fonts', 'public/fonts');
 
});


