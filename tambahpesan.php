<?php
require 'functions.php';

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

if( !isset($_SESSION["produk"]) ) {
    header("Location: marketplace.php");
    exit;
}

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

if( isset($_POST["simpan"]) ) {
    if(tambahpesan($_POST) > 0 ) {
        // Ke halaman pembayaran
        echo "
        <script type='text/javascript'>
            window.location = 'pembayaran.php'; 
        </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}

// Notif
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
    <title>TAMBAH PESANAN</title>
    <link rel="stylesheet" href="assets/stylenotif.css">
    <link rel="stylesheet" href="assets/styletambahpesan.css">
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
            <h1>Tambah Pesanan</h1>
        </div>

        <div>
            <form action="" method="post">
                <fieldset>

                <div class="form-grup">
                    <div class="label">
                        <label for="jumlahpesanan">Jumlah Pesanan</label>
                    </div>
                    <div class="input">
                        <input type="number" name="jumlahpesanan" placeholder="Masukkan Jumlah Pesanan" id="jumlahpesanan" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="alamatpengiriman">Alamat Pengiriman</label>
                    </div>
                    <div class="input">
                        <input type="text" name="alamatpengiriman" placeholder="Masukkan Alamat Pengiriman" id="alamatpengiriman" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="kodepos"></label>
                    </div>
                    <div class="input">
                        <input type="text" name="kodepos" placeholder="Masukkan Kode Pos" id="kodepos" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="notelp">Nomor Telepon</label>
                    </div>
                    <div class="input">
                        <input type="text" name="notelp" placeholder="Masukkan Nomor Telepon" id="notelp" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <button class="btn" type="submit" name="simpan">Simpan</button> 
                    <!-- Diarahkan ke pembayaran -->
                </div>

                

                </fieldset>
            </form>
        </div>

    </div>
    <script type="text/javascript" src="assets/script_notif.js"></script>
</body>
</html>