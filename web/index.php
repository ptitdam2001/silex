<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

// Definition
$app['debug'] = true;

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Default
$app['posts.controller'] = $app->share(function() use ($app) {
    return new ptitdam2001\Controllers\DefaultController();
});

//Error 
$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = array('code' => $code, 'msg' => $e->getMessage());
            break;
        default:
            $message = array('code' => $code, 'msg' => 'We are sorry, but something went terribly wrong.');
    }

    return new Response(json_encode($message));
});

// Routes
$app->get('/', "posts.controller:indexAction");


// Run
$app->run();