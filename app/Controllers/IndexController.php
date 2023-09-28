<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use GuzzleHttp\Client;

class IndexController
{
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index()
    {
        $client = new Client([
            'base_uri' => "https://dummyjson.com/"
        ]);

        $response = $client->patch("/products/1", [
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
