<?php

use App\Controllers\IndexController;
use App\Route;
use App\View;
use GuzzleHttp\Client;

$view = new View();
$httpClient = new Client();

$IndexController = new IndexController($view, $httpClient);

Route::get('/', function () use ($IndexController) {
    $IndexController->index();
});

Route::any('/not-found', function () use ($view) {
    $view->pageNotFound();
});
