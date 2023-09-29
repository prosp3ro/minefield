<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use Doctrine\DBAL\DriverManager;

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
        $file = __DIR__ . "/../../config/config.ini";
        $file = str_replace('\\', '/', $file);
        $config = parse_ini_file($file, true);
        $database = $config['database'];

        $dbDriver = $database['driver'];
        $dbHost = $database['host'];
        $dbName = $database['schema'];
        $dbUsername = $database['username'];
        $dbPassword = $database['password'];

        $connectionParams = [
            'dbname' => $dbName,
            'user' => $dbUsername,
            'password' => $dbPassword,
            'host' => $dbHost,
            'driver' => $dbDriver ?? 'pdo_mysql',
        ];

        $connection = DriverManager::getConnection($connectionParams);
        $queryBuilder = $connection->createQueryBuilder();

        $result = $queryBuilder
            ->select('*')
            ->from('books')
        ;

        $asd = $result->fetchAllAssociative();
        dd($asd);
        die();

        // $schema = $connection->createSchemaManager();
        // dd($schema->listTableColumns("books"));
        // die();

        // return $this->view->render("index");
    }
}
