<?php

require dirname(__DIR__).'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\Core\Application;
use App\Controller\HomeController;
use App\Controller\ItemController;

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]

    ];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [HomeController::class, 'index']);
$app->router->post('/', [HomeController::class, 'create']);

$app->router->get('/item', [ItemController::class, 'index']);
$app->router->post('/item', [ItemController::class, 'show']);

$app->run();

?>