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

// Gentelella vendors path : vendor/bower_components/gentelella/vendors

elixir(function(mix) {
    
    /***************************/
    /* Gentelella Stylesheets */
    /*************************/

    // Bootstrap
    mix.copy('vendor/bower_components/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css', 'public/css/bootstrap.min.css');

    // Font awesome
    mix.copy('vendor/bower_components/gentelella/vendors/font-awesome/css/font-awesome.min.css', 'public/css/font-awesome.min.css');

    // Gentelella
    mix.copy('vendor/bower_components/gentelella/build/css/custom.min.css', 'public/css/gentelella.min.css');

    /***********************/
    /* Gentelella Scripts */
    /*********************/

    // Bootstrap
    mix.copy('vendor/bower_components/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js', 'public/js/bootstrap.min.js');

    // jQuery
    mix.copy('vendor/bower_components/gentelella/vendors/jquery/dist/jquery.min.js', 'public/js/jquery.min.js');

    /***********************/
    /* iCheck Stylesheets */
    /*********************/

    // Flat Green Skin
    mix.copy('vendor/bower_components/icheck/skins/flat/green.css', 'public/css/green.css');

    // Js files
    mix.copy('vendor/bower_components/icheck/icheck.js', 'public/js/icheck.js');
    mix.copy('vendor/bower_components/icheck/icheck.min.js', 'public/js/icheck.min.js');

    /*********************/
    /* DataTables-bs js */
    /*******************/

    //css files
    mix.copy('vendor/bower_components/datatables.net-bs/css/dataTables.bootstrap.css', 'public/css/dataTables.bootstrap.css');
    mix.copy('vendor/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css', 'public/css/dataTables.bootstrap.min.css');

    // Js files
    mix.copy('vendor/bower_components/datatables.net-bs/js/dataTables.bootstrap.js', 'public/js/dataTables.bootstrap.js');
    mix.copy('vendor/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js', 'public/js/dataTables.bootstrap.min.js');

    /*********************/
    /* DataTables-js    */
    /*******************/

    // Js files
    mix.copy('vendor/bower_components/datatables.net/js/jquery.dataTables.js', 'public/js/jquery.dataTables.js');
    mix.copy('vendor/bower_components/datatables.net/js/jquery.dataTables.min.js', 'public/js/jquery.dataTables.min.js');
    

    /*********************/
    /* Flot-js    */
    /*******************/

    // Js files
    mix.copy('vendor/bower_components/flot/jquery.flot.js', 'public/js/jquery.flot.js');
    mix.copy('vendor/bower_components/flot/jquery.flot.time.js', 'public/js/jquery.flot.time.js');

    /**************/
    /* Copy Fonts */
    /**************/

    // Bootstrap
    mix.copy('vendor/bower_components/gentelella/vendors/bootstrap/fonts/', 'public/fonts');

    // Font awesome
    mix.copy('vendor/bower_components/gentelella/vendors/font-awesome/fonts/', 'public/fonts');
});
