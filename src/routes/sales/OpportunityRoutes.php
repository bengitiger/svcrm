<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$app->get('/sales/opportunities', function(Request $request, Response $response) {
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM opportunities";
	$res = $obj->query($query)->fetchAll(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
	echo $res;
});

$app->get('/sales/opportunity/{id}', function(Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM opportunities WHERE id = '$id'";
	$res = $obj->query($query)->fetch(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
	echo $res;
});
