<?php
require_once __DIR__.'/../vendor/autoload.php';

// Templating engine

$loader = new Twig_Loader_Filesystem('../templates/');
$twig = new Twig_Environment($loader);

// JSON REST API

$userId = "1665327528";
$userToken = "CAAF1hf9heNYBAKZCaLPzSPlmYaUZATANatT9uLZB5dlj4t7f8WbpRDA2oY6aEfZABLWTg5sE36T2PSyMMV9wHWOKj7WNnbFO5s2WX41rt9o8tJaHUUHh5NUY3Vz5O8M7ZBXdFFh8Y5t15gRXKCMie1IBIZAxJLPmUN8M1gHfascZAH7oZBDRjrApVjxU5Tdbh6EZD";

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

$klein->with('/api', function () use ($klein) {
	$klein->respond('GET', '/quest-opener', function ($request, $response) {
		header('Content-Type: application/json');
		header("Access-Control-Allow-Origin: *");

		$id = "847873595325488";

		global $userId, $userToken;

		$api = new \FacebookMining\FacebookAPI($userId, $userToken);

		$query = Array(
			"location" => "$id/comments",
			"parms" => Array(
				"limit" => 50
			)
		);

		$data = $api->request($query)->data;

		$data = $data["data"];

		$openers = Array();

		foreach($data as $comment){
	        $openers[] = $comment["message"];
		}

		echo json_encode($openers);
    });
	
	$klein->respond('GET', '/cold-read', function ($request, $response) {
		header('Content-Type: application/json');
		header("Access-Control-Allow-Origin: *");

		$id = "847181492061365";

		global $userId, $userToken;

		$api = new \FacebookMining\FacebookAPI($userId, $userToken);

		$query = Array(
			"location" => "$id/comments",
			"parms" => Array(
				"limit" => 50
			)
		);

		$data = $api->request($query)->data;

		$data = $data["data"];

		$openers = Array();

		foreach($data as $comment){
	        $openers[] = $comment["message"];
		}

		echo json_encode($openers);
    });

	$klein->respond('GET', '/opener', function ($request, $response) {
		header('Content-Type: application/json');
		header("Access-Control-Allow-Origin: *");

		$id = "846651678781013";

		global $userId, $userToken;

		$api = new \FacebookMining\FacebookAPI($userId, $userToken);

		$query = Array(
			"location" => "$id/comments",
			"parms" => Array(
				"limit" => 50
			)
		);

		$data = $api->request($query)->data;

		$data = $data["data"];

		$openers = Array();

		foreach($data as $comment){
	        $openers[] = $comment["message"];
		}

		echo json_encode($openers);
    });
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

