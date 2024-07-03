<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        .card {
            margin-bottom: 20px;
        }
        .card-img-top {
            max-height: 100px;
            object-fit: cover;
        }
        .total {
            font-weight: bold;
            font-size: 1.2rem;
        }
        
    </style>
    <style>
    @media (max-width: 991.98px) {
        .container {
            margin-top: 100px;
        }
    }

    @media (min-width: 992px) {
        .container {
            margin-top: 20px;
        }
    }
</style>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
     <!-- Midtrans -->
     <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-tW7HUGQzTTSdBhLl"></script>
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container mb-5 pb-5" >
        <h2 class="mb-4">Keranjang Belanja</h2>
        <div id="cartItems">
            <!-- Tempat untuk menampilkan daftar produk dalam keranjang -->
        </div>
        <hr>
        <div class="row">
            <h2>Informasi Customer</h2>
            <div class="col-md-6">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" placeholder="Masukkan Nama" name="name" class="form-control">
                    <label for="email">Email:</label>
                    <input type="email" id="email" placeholder="Masukkan Email" name="email" class="form-control">
                    <label for="phone">Nomor Telepon:</label>
                    <input type="text" id="phone" placeholder="Masukkan Nomor Telepon" name="phone" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="address">Alamat:</label>
                <input type="text" id="address" placeholder="Masukkan Alamat" name="address" class="form-control">
                <label for="city">Kota:</label>
                <input type="text" id="city" placeholder="Masukkan Kota" name="city" class="form-control">
                <label for="postalCode">Kode Pos:</label>
                <input type="text" id="postalCode" placeholder="Masukkan Kode Pos" name="postalCode" class="form-control">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <p class="text-right total">Total Harga Pesanan: <span id="totalPrice">0</span></p>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-light warna3 text-black" id="checkoutButton">Check Out</button>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery dan Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to load cart items on page load
            loadCartItems();

            // Function to load cart items via AJAX
            function loadCartItems() {
                $.ajax({
                    type: 'GET',
                    url: 'backend/get_cart_items.php', // Ganti dengan file PHP untuk mengambil data keranjang
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            displayCartItems(response.data);
                            updateTotalPrice(response.totalPrice);
                        } else {
                            alert('Failed to load cart items.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while fetching cart items.');
                    }
                });
            }

            window.removeCartItem = function (id) {
                $.ajax({
                    type: 'POST',
                    url: 'backend/remove_from_cart.php',
                    contentType: 'application/json',
                    data: JSON.stringify({ id: id }),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            loadCartItems();
                        } else {
                            alert('Failed to remove item from cart.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while removing item from cart.');
                    }
                });
            }

            // Function to display cart items
            function displayCartItems(cartItems) {
                $('#cartItems').empty(); // Kosongkan kontainer sebelum menambahkan item baru

                cartItems.forEach(function(item) {
                    var totalPrice = item.harga * item.quantity;
                    var html = `
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="/comelyflorist/image/${item.foto}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="card-title">${item.nama}</h5>
                                        <p class="card-text">Harga: ${formatRupiah(item.harga)}</p>
                                        <p class="card-text">Quantity: <input type="number" name="quantity" value="${item.quantity}" min="1" max="99" class="form-control form-control-sm w-25" onchange="updateQuantity(${item.id}, this.value)"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="card-text">Total: ${formatRupiah(totalPrice)}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger" onclick="removeCartItem(${item.id})">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#cartItems').append(html);
                });
            }

            window.updateQuantity = function (id, quantity) {
                $.ajax({
                    type: 'POST',
                    url: 'backend/update_cart_quantity.php',
                    contentType: 'application/json',
                    data: JSON.stringify({ id: id, quantity: +quantity }),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            loadCartItems();
                        } else {
                            alert('Failed to update quantity.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while updating quantity.');
                    }
                });
            }

            function formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
            }

            // Function to update total price
            function updateTotalPrice(totalPrice) {
                $('#totalPrice').text(formatRupiah(totalPrice));
            }

            $('#checkoutButton').click(function() {
                var cartItems = [];
                $('#cartItems .card').each(function() {
                    var item = {
                        id: $(this).find('button').attr('onclick').match(/\d+/)[0],
                        name: $(this).find('.card-title').text(),
                        price: parseInt($(this).find('.card-text').eq(0).text().replace(/[^0-9]/g, '')),
                        quantity: parseInt($(this).find('.form-control').val())
                    };
                    cartItems.push(item);
                });

                var totalPrice = $('#totalPrice').text();

                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var phone = document.getElementById('phone').value;
                var address = document.getElementById('address').value
                var city = document.getElementById('city').value
                var postalCode = document.getElementById('postalCode').value
                
                if (name === '' || email === '' || phone === '' || address === '' || city === '' || postalCode === '') {
                    alert('Please fill in all required fields.');
                    return;
                }

                var data = {
                    total: +totalPrice.replace(/[^0-9]/g, ''),
                    items: cartItems,
                    name,
                    email,
                    phone,
                    address,
                    city,
                    postalCode
                };

                $.ajax({
                    type: 'POST',
                    url: 'payment/placeOrder.php',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    dataType: 'json',
                    success: function(response) {
                        if (response.snapToken) {
                            snap.pay(response.snapToken, {
                                onSuccess: function(result) {
                                    location.href = '/comelyflorist';
                                },
                                onPending: function(result) {
                                    location.href = '/comelyflorist/cart.php';
                                },
                                onError: function(result) {
                                    location.href = '/comelyflorist';
                                },
                                onClose: function() {
                                    location.href = '/comelyflorist/cart.php';
                                }
                            });
                        } else {
                            alert('Failed to get Snap token.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error occurred while getting Snap token.');
                    }
                });
            });
        });
    </script>
</body>
</html>
