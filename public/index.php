<?php
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

$_SESSION['user_id'] = 'E53233DF-5BB2-4DD6-8473-A63DAA659F9B';


require '../vendor/autoload.php';
require '../src/classes/db.php';
require '../src/classes/utils.php';


$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');
});



# Routes

# User Routes
include_once '../src/routes/UserRoutes.php';

# Sales Routes
include_once '../src/routes/sales/SalesRoutes.php';
include_once '../src/routes/sales/AccountRoutes.php';
include_once '../src/routes/sales/OpportunityRoutes.php';
include_once '../src/routes/sales/LeadRoutes.php';
include_once '../src/routes/sales/ContactRoutes.php';


$app->run();
