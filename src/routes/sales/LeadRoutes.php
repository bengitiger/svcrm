<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';



// $app = new \Slim\App;

$app->get('/sales/leads', function(Request $request, Response $response) {
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM leads";
	$res = $obj->query($query)->fetchAll(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
	echo $res;
});

$app->get('/sales/lead/{id}', function(Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM leads WHERE id = '$id'";
	$res = $obj->query($query)->fetch(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
	echo $res;
});

$app->post('/sales/leads/add', function(Request $request, Response $response) {
	header("Content-Type: application/javascript");
    header("Access-Control-Allow-Headers: Content-Type");


	echo $_POST['name'];
});