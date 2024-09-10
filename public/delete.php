<?php
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../classes/Todo.php';
include_once '../utils/sanitize.php';

$database = new Database();
$db = $database->getConnection();

$todo = new Todo($db);

$data = json_decode(file_get_contents("php://input"));

$todo->id = sanitize($data->id);

if ($todo->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Todo was deleted."));
} else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete todo."));
}
