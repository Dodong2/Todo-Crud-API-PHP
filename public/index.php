<?php

header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../classes/Todo.php';

$database = new Database();
$db = $database->getConnection();


?>