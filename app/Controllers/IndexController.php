<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class IndexController
{
    private View $view;
    private Object $httpClient;

    public function __construct(View $view, Object $httpClient)
    {
        $this->view = $view;
        $this->httpClient = $httpClient;
    }

    public function index()
    {
        $response = $this->httpClient->patch("https://dummyjson.com/products/1", [
            "headers" => [
                "Content-type" => "application/json; charset=UTF-8"
            ],
            "body" => json_encode([
                "title" => "aaaaaaaaaaaaaaaaa"
            ])
        ]);

        $responseData = json_decode($response->getBody()->getContents());

        dd($responseData);
        die();

        return $this->view->render("index");
    }
}
