<?php
session_start();
require "../js/koneksi.php";

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // If user is not logged in, return an error response
        echo json_encode(array("success" => false, "message" => "User not logged in. Please log in first."));
        exit();
    }

// Function to sanitize and validate input
function sanitize_input($data) {
    global $con;
    $data = mysqli_real_escape_string($con, trim($data));
    return htmlspecialchars($data);
}

// Validate and sanitize input parameters
if (isset($_GET['id']) && isset($_GET['quantity'])) {
    $product_id = sanitize_input($_GET['id']);
    $quantity = sanitize_input($_GET['quantity']);

    // Validate if product exists (optional step)
    $queryCheckProduct = "SELECT * FROM produk WHERE id='$product_id'";
    $resultCheckProduct = mysqli_query($con, $queryCheckProduct);

    if (mysqli_num_rows($resultCheckProduct) > 0) {
        // Product exists, proceed to insert into cart table
        $user_id = $_SESSION['user_id'];

        // Check if the same product already exists in the cart for the user
        $queryCheckCart = "SELECT * FROM keranjang WHERE user_id='$user_id' AND product_id='$product_id'";
        $resultCheckCart = mysqli_query($con, $queryCheckCart);

        if (mysqli_num_rows($resultCheckCart) > 0) {
            // If product already exists in cart, update quantity
            $queryUpdateCart = "UPDATE keranjang SET quantity=quantity+'$quantity' WHERE user_id='$user_id' AND product_id='$product_id'";
            $resultUpdateCart = mysqli_query($con, $queryUpdateCart);

            if ($resultUpdateCart) {
                echo json_encode(array("success" => true, "message" => "Cart resultUpdateCart."));
            } else {
                echo json_encode(array("success" => false, "message" => "Failed to update cart."));
            }
        } else {
            // Insert new item into cart
            $queryInsertCart = "INSERT INTO keranjang (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
            $resultInsertCart = mysqli_query($con, $queryInsertCart);

            if ($resultInsertCart) {
                echo json_encode(array("success" => true, "message" => "Product added to cart.$resultInsertCart"));
            } else {
                echo json_encode(array("success" => false, "message" => "Failed to add to cart."));
            }
        }
    } else {
        // Product not found
        echo json_encode(array("success" => false, "message" => "Product not found."));
    }
} else {
    // Invalid or missing parameters
    echo json_encode(array("success" => false, "message" => "Invalid request parameters."));
}

?>
