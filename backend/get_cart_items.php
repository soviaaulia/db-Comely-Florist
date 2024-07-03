<?php
// Include koneksi ke database
require_once "../js/koneksi.php";

// Mulai session (jika belum dimulai)
session_start();

$response = ['status' => 'error', 'message' => '', 'data' => [], 'totalPrice' => 0];

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    // User logged in, fetch cart items for this user
    $userId = $_SESSION['user_id'];

    // Query untuk mengambil item keranjang belanja user dari tabel produk dan tabel keranjang
    $query = "SELECT p.id, p.nama, p.harga, p.foto, k.quantity
              FROM produk p
              JOIN keranjang k ON p.id = k.product_id
              WHERE k.user_id = ?";
    
    // Prepare statement
    $stmt = $con->prepare($query);
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("i", $userId);
        
        // Execute query
        if ($stmt->execute()) {
            // Get result
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $cartItems = [];
                $totalPrice = 0;

                // Loop through hasil query untuk membangun array data
                while ($row = $result->fetch_assoc()) {
                    $itemTotal = $row['harga'] * $row['quantity'];
                    $totalPrice += $itemTotal;

                    $cartItem = [
                        'id' => $row['id'],
                        'nama' => $row['nama'],
                        'harga' => $row['harga'],
                        'foto' => $row['foto'],
                        'quantity' => $row['quantity'],
                        'totalPrice' => $itemTotal
                    ];

                    // Masukkan item ke dalam array cartItems
                    $cartItems[] = $cartItem;
                    
                }

                // Set response status dan data
                $response['status'] = 'success';
                $response['data'] = $cartItems;
                $response['totalPrice'] = $totalPrice;
            } else {
                $response['message'] = 'Keranjang belanja Anda kosong.';
            }
        } else {
            $response['message'] = 'Error saat mengeksekusi query: ' . $stmt->error;
        }
        
        // Close statement
        $stmt->close();
    } else {
        $response['message'] = 'Error dalam persiapan statement: ' . $con->error;
    }
} else {
    $response['message'] = 'Anda belum login.';
}

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

// Menutup koneksi database
$con->close();
?>
