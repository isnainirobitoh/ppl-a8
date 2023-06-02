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

// Buat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

// Query untuk mengambil data pemesanan dan data produk
$query = "SELECT pemesanan.*, produk.nama_produk, produk.harga_produk, produk.stok
          FROM pemesanan
          JOIN produk ON pemesanan.id_produk = produk.id";
$result = mysqli_query($koneksi, $query);

$query_pendapatan = "SELECT SUM(pemesanan.jumlah_pesanan * produk.harga_produk) AS total_pendapatan
          FROM pemesanan
          JOIN produk ON pemesanan.id_produk = produk.id";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Riwayat Penjualan</title>

    <link rel="stylesheet" href="assets/stylepesananc.css">
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
                    <li><a href="#" class="notif"><i class="ri-notification-3-fill"></i></a></li>
                    <li><a href="profilM.php" class="user"><i class="ri-user-3-fill"></i></a></li>
                    <li><a href="logout.php">LOGOUT<i class="ri-logout-box-r-fill"></i></a></li>
                </ul>
            </nav>
        </div>

        <div class="header">
            <h1>Riwayat Penjualan</h1>
        </div>

        <div class="isi">
            <?php
            // Periksa apakah query berhasil dijalankan
            if ($result) {
                // Perulangan untuk mengambil setiap baris hasil query
                while ($row = mysqli_fetch_assoc($result)) {
                    // Tampilkan data pemesanan dan produk
                    // echo "ID Pemesanan: " . $row['id'] . "<br>";
                    echo "Nama Produk: " . $row['nama_produk'] . "<br>";
                    echo "Stok: " . $row['stok'] . "<br>";
                    echo "Harga Produk: " . $row['harga_produk'] . "<br>";
                    echo "Jumlah Pesanan: " . $row['jumlah_pesanan'] . "<br>";
                    echo "Tanggal Pesanan: " . $row['tanggal_pemesanan'] . "<br>";
                    echo "Alamat Pengiriman: " . $row['alamat_pengiriman'] . "<br>";
                    echo "Nomor Telepon Pemesan: " . $row['no_telp'] . "<br>";

                    echo "<br>";
                }

                // Bebaskan memori hasil query
                mysqli_free_result($result);
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }

            // menampilkan pendapatan
            $result_pendapatan = mysqli_query($koneksi, $query_pendapatan);

            // Periksa apakah query berhasil dijalankan
            if ($result_pendapatan) {
                $row = mysqli_fetch_assoc($result_pendapatan);
                $total_pendapatan = $row['total_pendapatan'];
            
                echo "Total Seluruh Pendapatan: Rp " . $total_pendapatan .".000,00";
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
            

            // Tutup koneksi
            mysqli_close($koneksi);
            ?>

            <br>
            
        </div>
        <button class="btn"><a href="marketplaceM.php">Kembali</a></button>
    </div>
</body>
</html>