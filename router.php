<?php

require 'config.php';
require 'controller/Todo.php';

$todoController = new TodoController();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $todoController->create_todo();
        break;
    case 'read':
        $todoController->get_todos();
        break;
    case 'delete':
        $todoController->delete_todo();
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
?>
