const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.js('resources/js/buttonsHandler.js', 'public/js')
mix.styles(['resources/css/login.css'], 'public/css/login.css')
mix.styles(['resources/css/home.css'], 'public/css/home.css')
mix.styles(['resources/css/users.css'], 'public/css/users.css')
mix.styles(['resources/css/user.css'], 'public/css/user.css')
mix.styles(['resources/css/item.css'], 'public/css/item.css')
mix.styles(['resources/css/items.css'], 'public/css/items.css')
mix.styles(['resources/css/createItem.css'], 'public/css/createItem.css')
mix.styles(['resources/css/createUser.css'], 'public/css/createUser.css')
mix.copyDirectory('resources/img', 'public/img')