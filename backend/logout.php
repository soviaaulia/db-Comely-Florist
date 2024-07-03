<?php
// Start session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Send a JSON response with status
header('Content-Type: application/json');

if (session_status() === PHP_SESSION_ACTIVE) {
    $response = [
        'status' => 'error',
        'message' => 'Failed to destroy session'
    ];
} else {
    $response = [
        'status' => 'success',
        'message' => 'Session destroyed successfully'
    ];
}

echo json_encode($response);
?>
