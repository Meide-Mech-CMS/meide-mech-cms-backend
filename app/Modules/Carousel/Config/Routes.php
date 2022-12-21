<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\carousel\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for Carousel ***/
    $subroutes->get('carousel', 'Carousel::index');
    $subroutes->get('carousel/add', 'Carousel::create');
    $subroutes->post('carousel', 'Carousel::store');
    $subroutes->get('carousel/edit/(:any)', 'Carousel::edit/$1');
    $subroutes->put('carousel/(:any)', 'Carousel::update/$1');
    $subroutes->delete('carousel/(:any)', 'Carousel::destroy/$1');
});

$routes->group('api', ['namespace' => 'App\Modules\carousel\Controllers'], function ($subroutes) {

    /*** Route API for Carousel ***/
    $subroutes->get('carousel', 'Carousel::getCarousel');
});