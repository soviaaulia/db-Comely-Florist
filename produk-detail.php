<?php 
    require "js/koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukRekomendasi = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comely Florist | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- detail produk-->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <img src="image/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                    <div class="col-lg-6 offset-lg-1">
                        <h1><?php echo $produk['nama'];?></h1>
                            <p class="fs-5 mt-5">
                                 <?php echo $produk['detail'];?>
                                    </p>
                                        <p class="text-harga">
                                            <strong>Rp. <?php echo number_format($produk['harga'], 0, ',', '.'); ?><strong>
                                             </p>
                                    <p class="fs-5">Stok Ketersediaan : <strong><?php echo $produk['ketersediaan_stok']?></strong></p>
                                 <!-- <a href="add_to_cart.php?id=<?php echo $produk['id']; ?>" class="d-block text-xl-start">
                            <p class="mt-2"><i class="fas fa-cart-plus"></i> Tambah ke Cart</p>
                        </a> -->
                   
                    <form class="add-to-cart-form">
                        <input type="number" name="quantity" value="1" min="1" class="form-control quantity-input">
                        <input type="hidden" name="product_id" value="<?php echo $produk['id']; ?>">
                        <button type="submit" class="btn btn-light warna4 mt-2">Tambah ke Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- rekomendasi produk-->
    <div class="container-fluid py-5 warna1">
        <div class="container">
            <h2 class="text-center text-white" style="margin-top: 10px; margin-bottom: 30px;" >Produk Terkait</h2>

            <div class="row">
                <?php while($data=mysqli_fetch_array($queryProdukRekomendasi)){?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                    <img src="image/<?php echo $data['foto']?>" class="img-fluid img-thumbnail produk-terkait-image" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>  
    <script src="fontawesome/js/all.min.js"></script> 
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart-form').submit(function(e) {
        e.preventDefault();
        
        var productId = $(this).find('input[name="product_id"]').val();
        var quantity = $(this).find('input[name="quantity"]').val();

        $.ajax({
            type: 'GET',
            url: 'backend/add_to_cart.php',
            data: { id: productId, quantity: quantity },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.success) {
                    // Handle success message or action
                    alert('Product added to cart!');
                } else {
                    // Handle error message
                    alert(response.message);
                    if(response.message == "User not logged in. Please log in first."){
                        window.location.href = 'auth.php';
                    }
                }
            },
            error: function() {
                // Handle AJAX errors
                alert('Error: Unable to process request.');
            }
        });
    });
});
</script>


</html>