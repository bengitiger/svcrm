<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';



$app = new \Slim\App;

$app->get('/', function(Request $request, Response $response) {
	echo 'Hello!';
	$guid = Utils::create_guid();
	echo $guid;
});

$app->get('/user/{username}', function(Request $request, Response $response) {
	$username = $request->getAttribute('username');
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM users WHERE username = '$username'";
	$res = $obj->query($query)->fetch(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
	echo $res;
});

$app->get('/users', function(Request $request, Response $response) {
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM users";
	$res = $obj->query($query)->fetch(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
    echo $res;
});
