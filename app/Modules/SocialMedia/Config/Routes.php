<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\SocialMedia\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for Social Media ***/
    $subroutes->get('social_media', 'SocialMedia::index');
    $subroutes->get('social_media/add', 'SocialMedia::create');
    $subroutes->post('social_media', 'SocialMedia::store');
    $subroutes->get('social_media/edit/(:any)', 'SocialMedia::edit/$1');
    $subroutes->put('social_media/(:any)', 'SocialMedia::update/$1');
    $subroutes->delete('social_media/(:any)', 'SocialMedia::destroy/$1');
});

$routes->group('admin/api', ['namespace' => 'App\Modules\SocialMedia\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for Social Media ***/
    $subroutes->add('social_media', 'SocialMedia::getAll');
    $subroutes->add('social_media/(:any)', 'SocialMedia::getOne/$1');
});