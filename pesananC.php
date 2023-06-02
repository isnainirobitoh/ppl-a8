<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

if( !isset($_SESSION["produk"]) ) {
    header("Location: marketplace.php");
    exit;
}

// Buat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

$id_customer = $_SESSION['user']['id'];

// Query untuk mengambil data pemesanan dan data produk
$query = "SELECT pemesanan.*, produk.nama_produk, produk.harga_produk, produk.jenis_produk, produk.deskripsi_produk, produk.gambar_produk, produk.stok, mitraa.namausaha
          FROM pemesanan
          JOIN produk ON pemesanan.id_produk = produk.id
          JOIN mitraa ON produk.id_mitra = mitraa.id
          WHERE pemesanan.id_customer = $id_customer";
$result = mysqli_query($koneksi, $query);

$userId = $_SESSION['user']['id'];
$query_role = "SELECT role FROM user_roles WHERE id = $userId";
$result_role = mysqli_query($koneksi, $query_role);

if ($result_role) {
    $row = mysqli_fetch_assoc($result_role);
    $userRole = $row['role'];
} else {
    echo "Error executing query: " . mysqli_error($koneksi);
}

$query_konsultasi = "SELECT id_customer FROM konsultasi WHERE id_customer = $userId";
$result_konsultasi = mysqli_query($koneksi, $query_konsultasi);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Pesanan Saya</title>
    <link rel="stylesheet" href="assets/stylenotif.css">
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
                    <li><a href="dashboardC.php">BERANDA</a></li>
                    <li><a href="diet.php">DIET</a></li>
                    <li><a href="artikel.php">ARTIKEL</a></li>
                    <li><a href="marketplace.php">MARKETPLACE</a></li>
                    <li>
                    <?php                       
                        if ($result_konsultasi && mysqli_num_rows($result_konsultasi) > 0) {
                            // Ada data konsultasi, menampilkan notifikasi
                            if ($userRole === 'premium') {
                                echo '<div class="dropdown">';
                                    echo '<button class="notif">' ;
                                    echo '<i class="ri-notification-3-fill"></i>';
                                    echo '</button>' ;
                                echo '<div class="dropdown-content">';
                                        echo '<h5>Fitur Reminder</h5>';
                                        echo '<button onclick="toggleNotification(true)">On</button> ';
                                        echo '<button onclick="toggleNotification(false)">Off</button>';
                                echo '</div>';
                                echo '</div>';
                        
                                echo '<script>';
                                echo 'function toggleNotification(enabled) {';
                                echo 'if (enabled) {';
                                    echo 'requestNotificationPermission();'; // Meminta izin notifikasi saat tombol "On" ditekan
                                    echo 'scheduleNotification(8, 0, "Waktunya untuk Sarapan");'; // Menjadwalkan notifikasi pada pukul 08:00 setiap hari
                                    echo 'scheduleNotification(13, 0, "Waktunya untuk Makan Siang");';
                                    echo 'scheduleNotification(17, 0, "Waktunya untuk Makan Malam");';
                                echo '}';
                                echo '}';
                                 echo '</script>';
                                } else if ($userRole === 'basic') {
                                    echo '<div class="dropdown">';
                                        echo '<button class="notif">' ;
                                        echo '<i class="ri-notification-3-fill"></i>';
                                        echo '</button>' ;
                                    echo '<div class="dropdown-content">';
                                        echo '<p>Silakan upgrade akun Anda ke premium untuk mengakses fitur reminder!';
                                        echo '<p>Lakukan pembayaran Anda pada Admin COD.tly</p>';
                                        echo '<p><a href="https://wa.me/6282334492141">Klik untuk melanjutkan</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                } else {
                                    echo '<div class="dropdown">';
                                        echo '<button class="notif">' ;
                                        echo '<i class="ri-notification-3-fill"></i>';
                                        echo '</button>' ;
                                    echo '<div class="dropdown-content">';
                                        echo '<p>Silakan upgrade akun Anda ke premium untuk mengakses fitur reminder!</p>';
                                        echo '<p>Lakukan pembayaran Anda pada Admin COD.tly</p>';
                                        echo '<p><a href="https://wa.me/6282334492141">Klik untuk melanjutkan</a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                        } else {
                            // Tidak ada data konsultasi, menampilkan pesan
                            echo '<div class="dropdown">';
                            echo '<button class="notif">';
                            echo '<i class="ri-notification-3-fill"></i>';
                            echo '</button>';
                            echo '<div class="dropdown-content">';
                            echo '<p>Isi data konsultasi dulu</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                    </li>
                    <li><a href="profil.php" class="user"><i class="ri-user-3-fill"></i></a></li>
                    <li><a href="logout.php">LOGOUT<i class="ri-logout-box-r-fill"></i></a></li>
                </ul>
            </nav>
        </div>

        <div class="header">
            <h1>Pesanan Saya</h1>
        </div>

        <div class="isi">
            <?php
            // Periksa apakah query berhasil dijalankan
            if (mysqli_num_rows($result) > 0) {
                // Perulangan untuk mengambil setiap baris hasil query
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='pesanan-container'>";
                    // menampilkan data pemesanan dan produk
                    echo "<div class='gambar-produk'>";
                    echo "<img src='" . $row['gambar_produk'] . "'>"; echo "<br>";
                    echo "Jenis Produk: " . $row['jenis_produk'] . "<br>";
                    echo "Nama Toko: " . $row['namausaha'] . "<br>";
                    echo "Nama Produk: " . $row['nama_produk'] . "<br>";
                    echo "Deskripsi Produk: " . $row['deskripsi_produk'] . "<br>";
                    echo "Jumlah Produk: " . $row['stok'] . "<br>";
                    echo "Harga Produk: " . $row['harga_produk'] . "<br>";
                    echo "Jumlah Pesanan: " . $row['jumlah_pesanan'] . "<br>";
                    echo "Alamat Pengiriman: " . $row['alamat_pengiriman'] . "<br>";
                    echo "Nomor Telepon: " . $row['no_telp'] . "<br>";
                    echo "</div>";

                    echo "<div class='bukti-pembayaran'>";
                    echo "Bukti Pembayaran:" . "<br>";
                    echo "<img src='" . $row['bukti_pembayaran'] . "'>";
                    echo "</div>";

                    // tombol "Batalkan" dengan mengirimkan ID pemesanan sebagai parameter
                    echo "<div class='button-container'>";
                    echo "<form method='POST' action='hapus_pemesanan.php'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<button class='btn' type='submit' onclick='return confirm(\"Apakah Anda yakin membatalkan pemesanan?\")'>Batalkan Pesanan</button>";
                    echo "</form>";
                    echo "</div>";

                    echo "</div>";
                    echo "<br>";
                }

                // Bebaskan memori hasil query
                mysqli_free_result($result);
            } else {
                // menampilkan pesan jika tidak ada pesanan
                echo "Anda tidak memiliki pesanan.";
            }

            // Tutup koneksi
            mysqli_close($koneksi);
            ?>

            <br>
            
        </div>
        <button class="btn"><a href="marketplace.php">Kembali</a></button>
    </div>
    <script type="text/javascript" src="assets/script_notif.js"></script>

</body>
</html>