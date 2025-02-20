<?php

use Slicettes\Controllers\HomepageController;
use Slicettes\Controllers\RecipeController;
use Slicettes\Controllers\UtilsController;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Middleware\MethodOverrideMiddleware; 

$app->add(new MethodOverrideMiddleware()); // <- allows use of _METHOD=[method I want] inside of a form to use any method I want. See delete.php in recipe views

$app->get('/', [HomepageController::class, 'view']);
$app->get('/homepage', [HomepageController::class, 'view']);

$app->get('/add[/]', [RecipeController::class, 'viewAddRecipe']);
$app->post('/add[/]', [RecipeController::class, 'saveRecipe']);

$app->get('/recipes[/]', [RecipeController::class, 'viewRecipes']);

$app->get('/recipes/detail/{id}[/]', [RecipeController::class, 'viewRecipe']);
$app->put('/recipes/detail/{id}[/]', [RecipeController::class, 'viewRecipe']);

$app->get('/recipes/delete/{id}[/]', [RecipeController::class, 'viewDeleteRecipe']);
$app->delete('/recipes/delete/{id}[/]', [RecipeController::class, 'deleteRecipe']);

$app->get('/404[/]', [UtilsController::class, 'notFound']);

$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function ($request, $handler) {
    $response = new \Slim\Psr7\Response();

    $ctrl = new UtilsController();
    return $ctrl->error($request, $response, ['code' => 404, 'message' => 'Page not found']);
});

$errorMiddleware->setErrorHandler(HttpMethodNotAllowedException::class, function ($request, $handler, $methods) {
    $response = new \Slim\Psr7\Response();

    $ctrl = new UtilsController();
    return $ctrl->error($request, $response, ['code' => 405, 'message' => 'Page not accessible with this method']);
});