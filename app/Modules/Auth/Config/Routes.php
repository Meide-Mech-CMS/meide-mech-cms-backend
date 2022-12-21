<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('', ['namespace' => 'App\Modules\Auth\Controllers'], function ($subroutes) {

    /*** Route for Auth ***/
    $subroutes->add('login', 'Auth::index');
    $subroutes->add('logout', 'Auth::logout', ['filter' => 'authGuard']);
    $subroutes->add('admin/activity', 'Auth::activity', ['filter' => 'authGuard']);
    $subroutes->post('signin', 'Auth::signin');
});