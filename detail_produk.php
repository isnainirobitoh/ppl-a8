<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginMverif.php");
    exit;
}

if( !isset($_SESSION["produk"]) ) {
    header("Location: marketplaceM.php");
    exit;
}

$_SESSION["produk"] = true;

$id = $_GET['id']; 

// Koneksi ke database
$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "phpdasar"; 
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk menampilkan produk berdasarkan ID
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Detail Produk</title>

    <link rel="stylesheet" href="assets/styledetailproduk.css">
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
            <?php
            $query = "SELECT * FROM produk WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<h2>" . $row['jenis_produk'] . "</h2>";
                
                } else {
                    echo "Produk tidak ditemukan";
                }
            ?>
        </div>
        
        <div class="row">
            <div class="col left">
                
                <?php
                $query = "SELECT * FROM produk WHERE id = $id";
                $result = mysqli_query($koneksi, $query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<img src='" . $row['gambar_produk'] . "'>";
                
                } else {
                    echo "Produk tidak ditemukan";
                }
                ?>
                <br>

                <?php
                $query = "SELECT * FROM produk WHERE id = $id";
                $result = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($result)) { 
                    echo "<form method='get' action='edit_produk.php'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<button type='submit'><i class='ri-pencil-line'></i>Ubah Data</button>";
                    echo "</form>";
                }
                ?>
                
            </div>
            <div class="col right">

                <?php
                // Tampilkan produk dalam bentuk HTML
                $query = "SELECT * FROM produk WHERE id = $id";
                $result = mysqli_query($koneksi, $query);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<p class='judul'>" . $row['nama_produk'] . "</p>";
                    echo "Deskripsi Produk:";
                    echo "<p class='desc'>" . $row['deskripsi_produk'] . "</p>";
                    echo "<p class='stok'>Jumlah Produk:</p>";
                    echo "<p>" . $row['stok'] . "</p>";
                    echo "<br>";
                    echo "Harga Produk:";
                    echo "<p class='harga'>" . $row['harga_produk'] . "</p>";
                } else {
                    echo "Produk tidak ditemukan";
                }
                ?>
                <br>
                <?php
                $query_nama = "SELECT p.*, m.namausaha FROM produk p
                                JOIN mitraa m ON p.id_mitra = m.id
                                WHERE p.id = $id";
                $result_nama = mysqli_query($koneksi, $query_nama);

                if (mysqli_num_rows($result_nama) > 0) {
                    $row = mysqli_fetch_assoc($result_nama);
                    echo "<p>Nama Toko: " . $row['namausaha'] . "</p>";
                } else {
                    echo "Produk tidak ditemukan";
                }

                // Tutup koneksi
                mysqli_close($koneksi);
                ?>
            </div>
        </div>

        <button class="clickme"><a href="marketplaceM.php">Kembali</a></button>
    </div>
</body>
</html>