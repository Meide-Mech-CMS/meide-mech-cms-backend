<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\ServiceFeature\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for Social Media ***/
    $subroutes->get('service_feature', 'ServiceFeature::index');
    $subroutes->get('service_feature/add', 'ServiceFeature::create');
    $subroutes->post('service_feature', 'ServiceFeature::store');
    $subroutes->get('service_feature/edit/(:any)', 'ServiceFeature::edit/$1');
    $subroutes->put('service_feature/(:any)', 'ServiceFeature::update/$1');
    $subroutes->delete('service_feature/(:any)', 'ServiceFeature::destroy/$1');
});

$routes->group('api', ['namespace' => 'App\Modules\ServiceFeature\Controllers'], function ($subroutes) {

    /*** Route API for Social Media ***/
    $subroutes->get('service_feature', 'ServiceFeature::getServiceFeature');
});