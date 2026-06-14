<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('admin-panel', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('auth/authenticate', 'AuthController::authenticate', ['filter' => 'loginThrottle']);
    $routes->get('logout', 'AuthController::logout');

    $routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

    $routes->get('settings', 'SettingsController::index', ['filter' => 'auth']);
    $routes->post('settings/save', 'SettingsController::save', ['filter' => 'auth']);

    $routes->get('pages', 'PagesController::index', ['filter' => 'auth']);
    $routes->get('pages/create', 'PagesController::create', ['filter' => 'auth']);
    $routes->post('pages/store', 'PagesController::store', ['filter' => 'auth']);
    $routes->get('pages/edit/(:num)', 'PagesController::edit/$1', ['filter' => 'auth']);
    $routes->post('pages/update/(:num)', 'PagesController::update/$1', ['filter' => 'auth']);
    $routes->post('pages/delete/(:num)', 'PagesController::delete/$1', ['filter' => 'auth']);
    $routes->get('pages/toggle/(:num)', 'PagesController::toggle/$1', ['filter' => 'auth']);
    $routes->post('pages/bulk-action', 'PagesController::bulkAction', ['filter' => 'auth']);

    $routes->get('files', 'FilesController::index', ['filter' => 'auth']);
    $routes->get('files/upload', 'FilesController::upload', ['filter' => 'auth']);
    $routes->post('files/store', 'FilesController::store', ['filter' => 'auth']);
    $routes->get('files/edit/(:num)', 'FilesController::edit/$1', ['filter' => 'auth']);
    $routes->post('files/update/(:num)', 'FilesController::update/$1', ['filter' => 'auth']);
    $routes->post('files/delete/(:num)', 'FilesController::delete/$1', ['filter' => 'auth']);
    $routes->post('files/bulk-action', 'FilesController::bulkAction', ['filter' => 'auth']);
    $routes->post('files/crop-image/(:num)', 'FilesController::cropImage/$1', ['filter' => 'auth']);

    $routes->post('editor/upload', 'EditorUploadController::upload', ['filter' => 'auth']);
    $routes->post('editor/upload-image', 'EditorUploadController::uploadImage', ['filter' => 'auth']);
    $routes->get('editor/ckeditor-browse', 'EditorUploadController::ckeditorBrowse', ['filter' => 'auth']);
    $routes->get('editor/get-files', 'EditorUploadController::getFiles', ['filter' => 'auth']);

    $routes->get('categories', 'CategoriesController::index', ['filter' => 'auth']);
    $routes->get('categories/create', 'CategoriesController::create', ['filter' => 'auth']);
    $routes->post('categories/store', 'CategoriesController::store', ['filter' => 'auth']);
    $routes->get('categories/edit/(:num)', 'CategoriesController::edit/$1', ['filter' => 'auth']);
    $routes->post('categories/update/(:num)', 'CategoriesController::update/$1', ['filter' => 'auth']);
    $routes->post('categories/delete/(:num)', 'CategoriesController::delete/$1', ['filter' => 'auth']);
});

$routes->get('/', 'SiteController::index');
$routes->get('contacts', 'SiteController::contacts');
$routes->get('/(:any)', 'SiteController::page/$1');
$routes->get('/(:any)/(:any)', 'SiteController::page/$1/$2');
$routes->get('/(:any)/(:any)/(:any)', 'SiteController::page/$1/$2/$3');
