<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\Partners\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for Partners ***/
    $subroutes->get('partners', 'Partners::index');
    $subroutes->get('partners/add', 'Partners::create');
    $subroutes->post('partners', 'Partners::store');
    $subroutes->get('partners/edit/(:any)', 'Partners::edit/$1');
    $subroutes->put('partners/(:any)', 'Partners::update/$1');
    $subroutes->delete('partners/(:any)', 'Partners::destroy/$1');
});

$routes->group('api', ['namespace' => 'App\Modules\Partners\Controllers'], function ($subroutes) {

    /*** Route API for Partners ***/
    $subroutes->get('partners', 'Partners::getPartners');
});