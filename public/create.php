<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../classes/Todo.php';
include_once '../utils/sanitize.php';

$database = new Database();
$db = $database->getConnection();

$todo = new Todo($db);

$data = json_decode(file_get_contents("php://input"));

// Validate title - must not be empty
if (empty($data->title)) {
    http_response_code(400); // Bad request
    echo json_encode(array("message" => "Title cannot be empty."));
    exit;
}

// Validate context - must not be empty
if (empty($data->context)) {
    http_response_code(400); // Bad request
    echo json_encode(array("message" => "Context cannot be empty."));
    exit;
}

// Validate time - must not be empty
if (empty($data->time)) {
    http_response_code(400); // Bad request
    echo json_encode(array("message" => "Time cannot be empty."));
    exit;
}




$todo->title = sanitize($data->title);
$todo->context = sanitize($data->context);
$todo->time = sanitize($data->time); 

if ($todo->create()) {
    http_response_code(201);
    echo json_encode(array("message" => "Todo was created."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to create todo."));
}
?>