<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$app->get('/sales/contacts', function(Request $request, Response $response) {
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM contacts";
	$res = $obj->query($query)->fetchAll(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
	echo $res;
});

$app->get('/sales/contact/{id}', function(Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$db = new DB;
	$obj = $db->connect();
	$query = "SELECT * FROM contacts WHERE id = '$id'";
	$res = $obj->query($query)->fetch(PDO::FETCH_OBJ);
	$res = json_encode($res);
	$db = null;
	echo $res;
});