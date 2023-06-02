<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
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
    <title>MARKETPLACE</title>

    <link rel="stylesheet" href="assets/stylenotif.css">
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

        <div class="top">
            <h1>Market Place</h1>
            <button><a href="pesananC.php"><i class="ri-shopping-cart-line"></i>Pesanan Saya</a></button>
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
                        echo "<form method='get' action='detail_produkC.php'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit'>Selengkapnya</button>";
                        echo "</form>";
                        echo "<br>";
                    } 
                    ?>
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
                        echo "<form method='get' action='detail_produkC.php'>";
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
    <script type="text/javascript" src="assets/script_notif.js"></script>
</body>
</html>