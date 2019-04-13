<?php

use Slim\Http\Request;
use Slim\Http\Response;

include_once('api.php');

$app->get('/', \App\Controllers\HomeController::class . ':index')->setName('base-url');
$app->get('/dashboard', \App\Controllers\HomeController::class . ':index');

$app->get('/users', \App\Controllers\UsersController::class . ':index');

$app->get('/categories', \App\Controllers\CategoryController::class . ':index');
$app->get('/categories/add', \App\Controllers\CategoryController::class . ':add');
$app->post('/categories/save', \App\Controllers\CategoryController::class . ':save');
$app->get('/categories/edit/{id}', \App\Controllers\CategoryController::class . ':edit');
$app->post('/categories/update/{id}', \App\Controllers\CategoryController::class . ':update');
$app->get('/categories/delete/{id}', \App\Controllers\CategoryController::class . ':delete');


$app->get('/ingredients', \App\Controllers\IngredientController::class . ':index');
$app->get('/ingredients/add', \App\Controllers\IngredientController::class . ':add');
$app->post('/ingredients/save', \App\Controllers\IngredientController::class . ':save');
$app->get('/ingredients/edit/{id}', \App\Controllers\IngredientController::class . ':edit');
$app->post('/ingredients/update/{id}', \App\Controllers\IngredientController::class . ':update');
$app->get('/ingredients/delete/{id}', \App\Controllers\IngredientController::class . ':delete');

$app->get('/pizzas', \App\Controllers\PizzaController::class . ':index');
$app->get('/pizzas/add', \App\Controllers\PizzaController::class . ':add');
$app->post('/pizzas/save', \App\Controllers\PizzaController::class . ':save');
$app->get('/pizzas/edit/{id}', \App\Controllers\PizzaController::class . ':edit');
$app->post('/pizzas/update/{id}', \App\Controllers\PizzaController::class . ':update');
$app->get('/pizzas/delete/{id}', \App\Controllers\PizzaController::class . ':delete');

$app->get('/sides', \App\Controllers\SidesController::class . ':index');
$app->get('/sides/add', \App\Controllers\SidesController::class . ':add');
$app->post('/sides/save', \App\Controllers\SidesController::class . ':save');
$app->get('/sides/edit/{id}', \App\Controllers\SidesController::class . ':edit');
$app->post('/sides/update/{id}', \App\Controllers\SidesController::class . ':update');
$app->get('/sides/delete/{id}', \App\Controllers\SidesController::class . ':delete');

$app->get('/drinks', \App\Controllers\DrinksController::class . ':index');
$app->get('/drinks/add', \App\Controllers\DrinksController::class . ':add');
$app->post('/drinks/save', \App\Controllers\DrinksController::class . ':save');
$app->get('/drinks/edit/{id}', \App\Controllers\DrinksController::class . ':edit');
$app->post('/drinks/update/{id}', \App\Controllers\DrinksController::class . ':update');
$app->get('/drinks/delete/{id}', \App\Controllers\DrinksController::class . ':delete');

