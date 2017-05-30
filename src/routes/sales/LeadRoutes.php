<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

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

$app->put('/sales/lead/edit/{id}', function(Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$title = $request->getParam('title');
	$name = $request->getParam('name');
	$email = $request->getParam('email');
	$department = $request->getParam('department');
	$primary_address = $request->getParam('primary_address');
	$mobile = $request->getParam('mobile');
	$description = $request->getParam('description');
	$office = $request->getParam('office');
	$fax = $request->getParam('fax');
	$source = $request->getParam('source');
	$referred_by = $request->getParam('referred_by');
	$website = $request->getParam('website');
	$status = $request->getParam('status');
	$status_description = $request->getParam('status_description');
	$campaign = $request->getParam('campaign');
	$opportunity_amount = $request->getParam('opportunity_amount');

	$db = new DB;
	$obj = $db->connect();
	$sql = "UPDATE leads SET
							name = :name, 
							title = :title,
							department = :department,
							primary_address = :primary_address,
							email = :email,
							description = :description,
							office_phone = :office_phone,
							mobile_phone = :mobile_phone,
							fax = :fax,
							website = :website,
							status = :status,
							status_description = :status_description,
							lead_source = :lead_source,
							referred_by = :referred_by,
							campaign = :campaign,
							opportunity_amount = :opportunity_amount
							WHERE id = :id";
	$stmt = $obj->prepare($sql);
	$stmt->execute(array(
		':id' => $id,
		':title' => $title,
		':name' => $name,
		':department' => $department,
		':primary_address' => $primary_address,
		':email' => $email,
		':description' => $description,
		':office_phone' => $office,
		':mobile_phone' => $mobile,
		':fax' => $fax,
		':website' => $website,
		':status' => $status,
		':status_description' => $status_description,
		':lead_source' => $source,
		':referred_by' => $referred_by,
		':campaign' => $campaign,
		':opportunity_amount' => $opportunity_amount
	));
});

$app->post('/sales/lead/delete/{id}', function(Request $request, Response $response) {
	$id = $request->getAttribute('id');
	$db = new DB;
	$obj = $db->connect();
	$query = "DELETE FROM leads WHERE id = '$id'";
	$obj->query($query);
	$db = null;
});

$app->post('/sales/leads/add', function(Request $request, Response $response) {
	$title = $request->getParam('title');
	$name = $request->getParam('name');
	$email = $request->getParam('email');
	$department = $request->getParam('department');
	$primary_address = $request->getParam('primary_address');
	$mobile = $request->getParam('mobile');
	$description = $request->getParam('description');
	$office = $request->getParam('office');
	$fax = $request->getParam('fax');
	$source = $request->getParam('source');
	$referred_by = $request->getParam('referred_by');
	$website = $request->getParam('website');
	$status = $request->getParam('status');
	$status_description = $request->getParam('status_description');
	$campaign = $request->getParam('campaign');
	$opportunity_amount = $request->getParam('opportunity_amount');

	$db = new DB;
	$obj = $db->connect();
	$stmt = $obj->prepare("INSERT INTO 
							leads 
								(id, name, title, department, primary_address, email, description, office_phone, mobile_phone, fax, website, other_address, status, status_description, lead_source, referred_by, campaign, opportunity_amount, user_id) 
						  VALUES 
						  		(:id, :name, :title, :department, :primary_address, :email, :description, :office_phone, :mobile_phone, :fax, :website, :other_address, :status, :status_description, :lead_source, :referred_by, :campaign, :opportunity_amount, :user_id)");
	$id = Utils::create_guid();
	$user_id = $_SESSION['user_id'];
	$stmt->execute(array (
		':id' => $id,
		':name' => $name,
		':title' => $title,
		':department' => $department,
		':primary_address' => $primary_address,
		':email' => $email,
		':description' => $description,
		':office_phone' => $office,
		':mobile_phone' => $mobile,
		':fax' => $fax,
		':website' => $website,
		':other_address' => '',
		':status' => $status,
		':status_description' => $status_description,
		':lead_source' => $source,
		':referred_by' => $referred_by,
		':campaign' => $campaign,
		':opportunity_amount' => $opportunity_amount,
		':user_id' => $user_id
	));

});