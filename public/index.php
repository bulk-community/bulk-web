<?php
require_once __DIR__.'/../vendor/autoload.php';

// Templating engine

$loader = new Twig_Loader_Filesystem('../templates/');
$twig = new Twig_Environment($loader);

//Router

$klein = new \Klein\Klein();

$klein->respond('GET', '/', function () {
	global $twig;

	return $twig->render('index.html', array('name' => 'nemanjan00'));
});


$klein->respond('GET', '/app/[*]', function () {
	global $twig;

	return $twig->render('index.html', array('name' => 'nemanjan00'));
});

// Handle errors

$klein->onHttpError(function ($code, $router) {
    switch ($code) {
        case 404:
            $router->response()->body(
                'Y U so lost?!'
            );
            break;
        case 405:
            $router->response()->body(
                'You can\'t do that!'
            );
            break;
        default:
            $router->response()->body(
                'Oh no, a bad error happened that caused a '. $code
            );
    }
});

$klein->dispatch();

