<?php

if (!isset($routes)) {
    $routes = \Config\Services::routes(true);
}

$routes->group('admin', ['namespace' => 'App\Modules\CompanyLogo\Controllers', 'filter' => 'authGuard'], function ($subroutes) {

    /*** Route for Company Logo ***/
    $subroutes->get('company_logo', 'CompanyLogo::index');
    $subroutes->get('company_logo/add', 'CompanyLogo::create');
    $subroutes->post('company_logo', 'CompanyLogo::store');
    $subroutes->get('company_logo/edit/(:any)', 'CompanyLogo::edit/$1');
    $subroutes->put('company_logo/(:any)', 'CompanyLogo::update/$1');
    $subroutes->delete('company_logo/(:any)', 'CompanyLogo::destroy/$1');
});

$routes->group('api', ['namespace' => 'App\Modules\CompanyLogo\Controllers'], function ($subroutes) {

    /*** Route API for Company Logo ***/
    $subroutes->get('company_logo', 'CompanyLogo::getCompanyLogo');
});