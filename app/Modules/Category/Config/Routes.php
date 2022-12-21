<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\category\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for category ***/
    $subroutes->get('category', 'Category::index');
    $subroutes->get('category/add', 'Category::create');
    $subroutes->post('category', 'Category::store');
    $subroutes->get('category/edit/(:any)', 'Category::edit/$1');
    $subroutes->put('category/(:any)', 'Category::update/$1');
    $subroutes->delete('category/(:any)', 'Category::destroy/$1');
});

$routes->group('api', ['namespace' => 'App\Modules\category\Controllers'], function ($subroutes) {

    /*** Route API for category ***/
    $subroutes->get('category', 'Category::getCategory');
});