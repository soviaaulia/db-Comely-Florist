<?php
require_once "../js/koneksi.php"; // Adjust this to your database connection file

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["loginName"];
    $password = $_POST["loginPassword"];

    // Query to check if the username or email exists
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verify password (assuming it's stored as SHA-256 hash)
        if (hash_equals($user['password'], hash('sha256', $password))) {
            // Password is correct, create session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Return success response
            $response['status'] = 'success';
            $response['message'] = 'Login successful.';
            // header("Location: index.php");
        } else {
            // Password is incorrect
            $response['message'] = 'Invalid username/email or password.';
        }
    } else {
        // User not found
        $response['message'] = 'Invalid username/email or password.';
    }
} else {
    // Invalid request method
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);

$con->close();
?>
