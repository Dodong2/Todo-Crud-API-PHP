<?php

class TodoController {
    // Create a new Todo
    public function create_todo() {
        global $conn;

        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $time = $_POST['time'] ?? '';

        // Validate input
        if (empty($title) || empty($content) || empty($time)) {
            $response = ['success' => false, 'message' => 'Title, content, and time cannot be empty'];
            echo json_encode($response);
            return;
        }

        // Insert data into the database
        $stmt = $conn->prepare('INSERT INTO todos (title, content, time) VALUES (?, ?, ?)');

            // Check if preparation was successful
            if ($stmt === false) {
                $response = ['success' => false, 'message' => 'SQL prepare error: ' . $conn->error];
                echo json_encode($response);
                return;
            }
            
        $stmt->bind_param('sss', $title, $content, $time);

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Todo created successfully'];
        } else {
            $response = ['success' => false, 'message' => 'Failed to create Todo: ' . $stmt->error];
        }

        $stmt->close();
        echo json_encode($response);
    }

    // Get all Todos
    public function get_todos() {
        global $conn;

        $result = $conn->query('SELECT * FROM todos');
        $todos = [];

        while ($row = $result->fetch_assoc()) {
            $todos[] = $row;
        }

        $response = ['success' => true, 'todos' => $todos];
        echo json_encode($response);
    }

    // Delete a Todo by ID
    public function delete_todo() {
        global $conn;
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            $response = ['success' => false, 'message' => 'ID is required'];
            echo json_encode($response);
            return;
        }

        $stmt = $conn->prepare('DELETE FROM todos WHERE id = ?');
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $response = ['success' => true, 'message' => 'Todo deleted successfully'];
        } else {
            $response = ['success' => false, 'message' => 'Failed to delete Todo'];
        }

        $stmt->close();
        echo json_encode($response);
    }
}
?>
