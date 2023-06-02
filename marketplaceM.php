<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginMverif.php");
    exit;
}

$_SESSION["produk"] = true;

$host = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "phpdasar";

$koneksi = mysqli_connect($host, $username, $password, $database);

// cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>MARKETPLACE</title>

    <link rel="stylesheet" href="assets/stylemarketplacem.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="navbar">
            <a href="#" class="logo"><i class="ri-home-heart-fill"></i><span>COD.tly</span></a>
            <nav>
                <ul>
                    <li><a href="dashboardM.php">BERANDA</a></li>
                    <li><a href="artikelM.php">ARTIKEL</a></li>
                    <li><a href="marketplaceM.php">MARKETPLACE</a></li>
                    <li><a href="profilM.php" class="user"><i class="ri-user-3-fill"></i></a></li>
                    <li><a href="logout.php">LOGOUT<i class="ri-logout-box-r-fill"></i></a></li>
                </ul>
            </nav>
        </div>

        <div class="top">
            <h1>Market Place</h1>
            <button><a href="tambahproduk.php"><i class="ri-add-circle-line"></i>Tambah Produk</a></button>
            <button><a href="pesananM.php"><i class="ri-shopping-cart-line"></i>Pesanan</a></button>
            <button><a href="riwayat_penjualan.php"><i class="ri-store-2-line"></i>Riwayat Penjualan</a></button>
        </div>

        <div class="row">
            <div class="col left">
                <h1>Makanan</h1>
                <div class="isi">
                    <?php
                    // Query untuk menampilkan daftar artikel
                    $query = "SELECT * FROM produk WHERE jenis_produk = 'makanan'";
                    $result = mysqli_query($koneksi, $query);

                    // Menampilkan daftar produk dalam bentuk HTML
                    while ($row = mysqli_fetch_assoc($result)) { 
                        echo "<img src='" . $row['gambar_produk'] . "'>";
                        echo "<p class='judul'>" . $row['nama_produk'] . "</p>";
                        echo "<p class='desc'>" . $row['deskripsi_produk'] . "</p>";
                        echo "<p class='harga'>" . $row['harga_produk'] . "</p>";
                        echo "<form method='get' action='detail_produk.php'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit'>Selengkapnya</button>";
                        echo "</form>";
                        echo "<br>";
                    } 

                    // Tutup koneksi
                    // mysqli_close($koneksi);
                    ?>
         
                <!-- <div class="isi">
                    <img src="images/catering.jpg">
                    <p class="judul">Judul Makanan</p>
                    <p class="desc">Deskripsi</p>
                    <p class="harga">Rp ... </p>
                    <a href="detail_produk.php">Selengkapnya</a>
                </div> -->
            </div>
        </div>
            <div class="col right">
                <h1>Minuman</h1>
                <div class="isi">
                    <?php
                    // Query untuk menampilkan daftar artikel
                    $query = "SELECT * FROM produk WHERE jenis_produk = 'minuman'";
                    $result = mysqli_query($koneksi, $query);

                    // Menampilkan daftar produk dalam bentuk HTML
                    while ($row = mysqli_fetch_assoc($result)) { 
                        echo "<img src='" . $row['gambar_produk'] . "'>";
                        echo "<p class='judul'>" . $row['nama_produk'] . "</p>";
                        echo "<p class='desc'>" . $row['deskripsi_produk'] . "</p>";
                        echo "<p class='harga'>" . $row['harga_produk'] . "</p>";
                        echo "<form method='get' action='detail_produk.php'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit'>Selengkapnya</button>";
                        echo "</form>";
                        echo "<br>";
                    } 

                    // Tutup koneksi
                    mysqli_close($koneksi);
                    ?>
                </div>
                
            </div>
        </div> 
    </div>
</body>
</html>