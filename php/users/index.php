<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../core.php';
include_once '../config/database.php';
include_once '../src/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$data = [];

// LIST
if ( $_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_REQUEST['id']) ) {
	$stmt = $user->list();
	$num = $stmt->rowCount();

	if ($num > 0) {
		$users = [];
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			extract($row);

			$item = [
	            "id" => $id,
	            "name" => $name,
	            "email" => $email,
	            "created_at" => $created_at,
	            "updated_at" => $updated_at
	        ];

	        array_push($users, $item);
		}

		http_response_code(200);
		echo json_encode($users);
	} else {
		http_response_code(404);
		echo json_encode(["message" => "No users found."]);
	}
}

// CREATE
// READ
// UPDTE
// DESTROY	
