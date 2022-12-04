<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\Certificate\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for Social Media ***/
    $subroutes->get('certificate', 'Certificate::index');
    $subroutes->get('certificate/add', 'Certificate::create');
    $subroutes->post('certificate', 'Certificate::store');
    $subroutes->get('certificate/edit/(:any)', 'Certificate::edit/$1');
    $subroutes->put('certificate/(:any)', 'Certificate::update/$1');
    $subroutes->delete('certificate/(:any)', 'Certificate::destroy/$1');
});