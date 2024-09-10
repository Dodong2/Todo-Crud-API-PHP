<?php

// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

class Database
{

    public function getConnection()
    {
        // Database configuration
        // Check if constants are already defined before defining them
        if (!defined('DB_HOST')) {
            define('DB_HOST', 'localhost');
        }
        if (!defined('DB_USER')) {
            define('DB_USER', 'root');
        }
        if (!defined('DB_PASSWORD')) {
            define('DB_PASSWORD', '');
        }
        if (!defined('DB_NAME')) {
            define('DB_NAME', 'todo_app');
        }


        // Create connection
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Check for connection error
        if ($conn->connect_error) {
            $response = array(
                'success' => 'false',
                'message' => 'Database connection failed: ' . $conn->connect_error
            );
            echo json_encode($response);
            exit();
        }

        // Return connection if successful
        return $conn;
    }
}

$database = new Database();
$conn = $database->getConnection();

// If connection is successful
if ($conn) {
    $response = array(
        'success' => 'true',
        'message' => 'Database connection successful'
    );
    echo json_encode($response);
}


// para sa defined ng DB_
// define('DB_HOST', 'localhost');
//         define('DB_USER', 'root');
//         define('DB_PASSWORD', '');
//         define('DB_NAME', 'todo_app');
