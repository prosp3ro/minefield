<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class IndexController
{
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index()
    {
        return $this->view->render("index");
    }
}
