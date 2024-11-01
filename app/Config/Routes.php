<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('site');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::site');
$routes->post("/api/user/salvarfoto", "Api\Foto::create");
$routes->get("api/motoboys/user/(.*)", "Api\Motoboy::getByUserId/$1");
$routes->get("api/empresas/user/(.*)", "Api\Empresa::getByUserId/$1");
$routes->resource('api/motoboys', ['controller' =>'Api\Motoboy']);
$routes->resource('api/empresas', ['controller' =>'Api\Empresa']);

$routes->get('api/empresa/encomendas/pendentes', "Api\Empresa\Encomenda::pendentes");
$routes->get('api/empresa/encomendas/finalizadas', "Api\Empresa\Encomenda::finalizadas");
$routes->resource('api/empresa/encomendas', ['controller' =>'Api\Empresa\Encomenda']);


$routes->get('api/motoboy/encomendas/novas', "Api\Motoboy\Encomenda::novas");
$routes->get('api/motoboy/encomendas/minhas', "Api\Motoboy\Encomenda::minhas");
$routes->get('api/motoboy/candidatar/entrega/(.*)', "Api\Motoboy\Encomenda::candidatar/$1");
$routes->get('api/motoboy/confirma/entrega/(.*)', "Api\Motoboy\Encomenda::confirmarEntrega/$1");


$routes->post("/app/login", "Auth::login");
$routes->post("/app/register", "Auth::register");
