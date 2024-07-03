<?php
session_start();
require '../js/koneksi.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$quantity = $data['quantity'];
$user_id = $_SESSION['user_id'];

if (isset($user_id) && isset($id)) {
    $query = "UPDATE keranjang SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$id'";
    $result = mysqli_query($con, $query);
    
    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to remove item from cart.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid user ID or item ID.']);
}
?>
