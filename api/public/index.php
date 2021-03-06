<?php

use SLIMAPI\Controller\API\includes\ErrorHandler;
use SLIMAPI\Controller\API\includes\PhpErrorHandler;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';

$app = new \Slim\App($settings);
$c = $app->getContainer();
// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
$routes = scandir(__DIR__ . '/../src/Routes/');
foreach ($routes as $route) {
    if (strpos($route, '.php')) {
        require __DIR__ . '/../src/Routes/' . $route;
    }
}

//$app->add(new \Slim\Middleware\JwtAuthentication([
//    "path" => "/admin", /* or ["/api", "/admin"] */
//    "secret" => "supersecretkeyyoushouldnotcommittogithub"
//]));

// Run app
$app->run();
