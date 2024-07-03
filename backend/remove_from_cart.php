<?php
session_start();
require '../js/koneksi.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$itemId = $data['id'];
$user_id = $_SESSION['user_id'];

if (isset($user_id) && isset($itemId)) {
    $query = "DELETE FROM keranjang WHERE user_id = '$user_id' AND product_id = '$itemId'";
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
