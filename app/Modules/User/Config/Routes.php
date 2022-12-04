<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\User\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for User ***/
    $subroutes->get('user', 'User::index', ['filter' => 'authAdmin']);
    $subroutes->get('user/add', 'User::create', ['filter' => 'authAdmin']);
    $subroutes->post('user', 'User::store', ['filter' => 'authAdmin']);
    $subroutes->get('user/edit/(:any)', 'User::edit/$1', ['filter' => 'authAdmin']);
    $subroutes->put('user/(:any)', 'User::update/$1', ['filter' => 'authAdmin']);
    $subroutes->delete('user/(:any)', 'User::destroy/$1', ['filter' => 'authAdmin']);
});

$routes->group('admin/api', ['namespace' => 'App\Modules\User\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for User ***/
    $subroutes->add('user', 'User::getAll');
    $subroutes->add('user/(:any)', 'User::getOne/$1');
});