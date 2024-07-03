<?php
    require "js/koneksi.php";
    $queryProduk = mysqli_query($con,"SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <metah http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comely Florist | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

<!-- Kotak Pencarian di Atas Kanan Banner -->
<div class="container">
        <div class="search-box-container">
            <form class="d-flex" method="get" action="produk.php">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Nama Produk" aria-label="Search" name="keyword">
                    <button class="btn btn-light warna4 text-black" type="submit">Telusuri</button>
                </div>
            </form>
        </div>
    </div>


    <!--banner -->
    <div class="container-fluid banner d-flex align-items-center">
    <div class="container text-start text-black">
    <h1 class="custom-h1">Berikan setiap momen</h1>
    <h1 class="custom-h1">yang indah</h1>
    <h5 class="text-center-h5">Ingin mengirimkan ucapan selamat atas cinta dan dukungan Anda? Apapun pesan yang ingin Anda sampaikan,</h5>
    <h5 class="text-center-h5">Kami menawarkan berbagai rangkaian buket bunga, buket snack, buket uang untuk segala acara</h5>
    <div class="col-md-8 offset-md-2">
        </div>
    </div>
</div>

<!-- highlighted kategori-->
<div class="container-fluid py-5">
    <div class="container text-center">
            <h3>Kategori Terlaris</h3>

            <div class="row mt-5">
                <div class="col-md-4 mb-3">
                    <div class="highlighted-kategori kategori-Flowers-Bouquet d-flex justify-content-center
                    align-items-center">
                        <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Flowers Bouquet">Flowers Bouquet</a></h4>
                    </div>
                </div>
                    <div class="col-md-4 mb-3">
                        <div class="highlighted-kategori kategori-Snack-Bouquet d-flex justify-content-center
                    align-items-center">
                            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Snack Bouquet">Snack Bouquet</a></h4>
                    </div>
                </div>
                    <div class="col-md-4 mb-3">
                        <div class="highlighted-kategori kategori-Money-Bouquet d-flex justify-content-center
                    align-items-center">
                            <h4 class="text-white"><a class="no-decoration" href="produk.php?kategori=Money Bouquet">Money Bouquet</a></h4>
                    </div>
                </div>
            </div>
    </div>  
</div>

<!--tentang kami -->
<div class="container-fluid warna3 py-5">
    <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">
                Comely Florist merupakan toko bunga yang berlokasi di Jl.Makmur IV, Kel.Susukan Kec.Ciracas Jakarta Timur 
            yang berdiri sejak tahun 2023 dan menyediakan berbagai rangkaian bunga berkualitas untuk berbagai momen spesial anda
            khususnya bagi anda yang berlokasi di wilayah Jakarta. daerah.
                Comely Florist menyediakan jasa pembuatan bunga yang cepat dan terjangkau 
            sehingga memudahkan pelanggan untuk mendapatkan bunga yang indah tanpa harus menunggu lama dan menguras kantong.
            </p>
    </div>
</div>

<!--produk-->
<div class="container-fluid py-5">
<div class="container text-center">
    <h3>Produk</h3>

    <div class="row mt-5">
        <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
        <div class="col-sm-6 col-md-4 mb-3">
            <div class="card h-100">
                <div class="image-box">
                <img src="image/<?php echo $data['foto'];?>" class="card-img-top" alt="...">
                </div>
            <div class="card-body">
                    <h4 class="card-title"><?php echo $data['nama'];?></h4>
                    <p class="card-text text-truncate"><?php echo $data['detail'];?></p>
                    <p class="card-text text-harga">Rp <?php echo number_format($data['harga'], 0, ',', '.');?></p>
                    <a href="produk-detail.php?nama=<?php echo $data['nama'];?>" 
                    class="btn btn-secondary warna2 text-white">Lihat Detail</a>
                    </div>
                </div>
            </div>
                <?php } ?>
                    </div>
                 <div class="d-flex justify-content-center">
                    <a class="btn btn-outline-secondary mt-3 p-3 fs-7" href="produk.php">See More</a>
                </div>
            </div>
        </div>

<!--footer-->
<?php require "footer.php"; ?>
         
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>