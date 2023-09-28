<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Exception;

class IndexController
{
    private View $view;
    private Object $httpClient;
    private string $emailableUrl = "https://api.emailable.com/v1/verify?email=";
    private string $email = "abc@gmail.com";

    public function __construct(View $view, Object $httpClient)
    {
        $this->view = $view;
        $this->httpClient = $httpClient;
    }

    public function index()
    {
        // $response = $this->httpClient->patch("https://dummyjson.com/products/1", [
        //     "headers" => [
        //         "Content-type" => "application/json; charset=UTF-8"
        //     ],
        //     "body" => json_encode([
        //         "title" => "aaaaaaaaaaaaaaaaa"
        //     ])
        // ]);

        // $responseData = json_decode($response->getBody()->getContents());

        // dd($responseData);
        // die();

        $handle = curl_init();

        curl_setopt_array($handle, [
            CURLOPT_URL => $this->emailableUrl . $this->email . "&api_key=" . EMAILABLE_API_KEY,
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_CUSTOMREQUEST => "POST",
            // CURLOPT_POST => true,
            // CURLOPT_POSTFIELDS => http_build_query($reqBody),
            // CURLOPT_HTTPHEADER => $reqHeaders
        ]);

        // dd(curl_getinfo($handle));

        $response = curl_exec($handle);
        // dd(curl_getinfo($handle));

        if ($error = curl_error($handle)) {
            dd($error);
        }

        // dd($response);
        // die();

        $responseData = json_decode($response);

        if ($responseData->reason === "accepted_email") {
            dd("email accepted");
            die();
        } else {
            dd("email not accepted");
            die();
        }


        // return $this->view->render("index");
    }
}
