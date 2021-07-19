<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../core.php';
include_once '../config/database.php';
include_once '../config/sanitize.php';
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
if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	$data = sanitize(json_decode(file_get_contents("php://input"), true));

	//VALIDATION
	$errors = $user->validate($data);

	if (count($errors) > 0) {
		http_response_code(422);
		echo json_encode($errors);
	} else {
		$user->name = $data['name'];
    	$user->email = $data['email'];
       	$user->created_at = date('Y-m-d H:i:s');
       	$user->updated_at = date('Y-m-d H:i:s');

       	if ( $user->create() ) {
       		$user->id = $db->lastInsertId();
            http_response_code(201);
         	echo json_encode($user);
    	} else {
       		http_response_code(503);
            echo json_encode(array("message" => "Unable to create user."));
    	}
	}
}
// READ
// UPDTE
// DESTROY	
