<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Database configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'todo_app');
// Create connection
    $conn = new mysqli(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME);

// Create connection
// if error
    if ($conn->connect_error) {
        $response = array(
            'success' => 'false',
            'message' => 'Database connection failed: ' . $conn->connect_error
        );
        
        echo json_encode($response);
        exit();
    }

// if success
    $response = array(
        'success' => 'true',
        'message' => 'Database connection successful tangina'
    );

    echo json_encode($response);

?>