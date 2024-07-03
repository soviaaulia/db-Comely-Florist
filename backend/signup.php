<?php
    require "../js/koneksi.php";

// Function to validate email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to check if all fields are filled
function checkFields($name, $username, $email, $password, $repeatPassword) {
    return !empty($name) && !empty($username) && !empty($email) && !empty($password) && !empty($repeatPassword);
}

// Function to encrypt password
function encryptPassword($password) {
    return hash('sha256', $password);
}

// Function to check if role exists (assuming role 2 for customer)
function roleExists($con, $roleId) {
    $stmt = $con->prepare("SELECT id FROM role WHERE id = ?");
    $stmt->bind_param("i", $roleId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    $role = 2; // Assuming role 2 for customer

    // Check all field validation
    if (!checkFields($name, $username, $email, $password, $repeatPassword)) {
        $response['message'] = "All fields are required.";
    } elseif (!validateEmail($email)) {
        $response['message'] = "Invalid email format.";
    } elseif ($password !== $repeatPassword) {
        $response['message'] = "Passwords do not match.";
    } elseif (!roleExists($con, $role)) {
        $response['message'] = "The specified role does not exist.";
    } else {
        // Encrypt the password
        $encryptedPassword = encryptPassword($password);

        // Insert data into the database
        $stmt = $con->prepare("INSERT INTO users (username, password, name, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $encryptedPassword, $name, $role);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = "Registration successful.";

            session_start();
            $_SESSION['user_id'] = $stmt->insert_id; // Assuming 'id' is your auto-increment primary key
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;
        } else {
            $response['message'] = "Error: " . $stmt->error;
        }
    }
}

echo json_encode($response);

$con->close();
?>