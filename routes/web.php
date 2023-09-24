<?php

use App\Controllers\IndexController;
use App\Route;
use App\View;

$view = new View();

$IndexController = new IndexController($view);

Route::get('/', function () use ($IndexController) {
    $IndexController->index();
});

Route::any('/not-found', function () use ($view) {
    $view->pageNotFound();
});
