<?php

header("Content-Type: application/json; charset=UTF-8");


include_once '../config/database.php';
include_once '../classes/Todo.php';

$database = new Database();
$db = $database->getConnection();

$todo = new Todo($db);

$stmt = $todo->read();
$num = $stmt->num_rows;

if ($num > 0) {
    $todos_arr = array();
    while ($row = $stmt->fetch_assoc()) {
        $todo_item = array(
            "id" => $row['id'],
            "title" => $row['title'],
            "context" => $row['context'],
            "time" => $row['time']
        );
        array_push($todos_arr, $todo_item);
    }
    http_response_code(200);
    echo json_encode($todos_arr);
} else {
    http_response_code(404);
    echo json_encode(array("message" => "No todos found."));
}

?>
