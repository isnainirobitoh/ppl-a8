<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

$conn = mysqli_connect("localhost","root","","phpdasar"); 

$userId = $_SESSION['user']['id'];
$query = "SELECT role FROM user_roles WHERE id = $userId";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userRole = $row['role'];
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

$query_konsultasi = "SELECT id_customer FROM konsultasi WHERE id_customer = $userId";
$result_konsultasi = mysqli_query($conn, $query_konsultasi);
// Tutup koneksi
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="assets/styledashboard.css">
    <link rel="stylesheet" href="assets/stylenotif.css">
    
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
        <div class="row">
            <div class="col">
                <h1>WELCOME COD.tly</h1>
                <p>Taukah kamu? Bahwa mengkonsumsi makanan sehat sangat berpengaruh bagi kesehatan tubuh. 
                </p>

            </div>
            <div class="col">
                <div class="card card1">
                    <h5>Makanan Bergizi</h5>
                    <p>
                        Penting untuk menjaga kesehatan dan menjauhkan penyakit dari tubuh.
                    </p>
                </div>
                <div class="card card2">
                    <h5>Olahraga Teratur</h5>
                    <p>
                        Olahraga rutin setiap hari dapat memperkuat otot jantung.
                    </p>
                </div>
                <div class="card card3">
                    <h5>Makanan Seimbang</h5>
                    <p>
                        Menu dengan beranekaragam makanan dalam proporsi yang sesuai.
                    </p>
                </div>
                <div class="card card4">
                    <h5>DIET</h5>
                    <p>
                        Pada dasarnya adalah pola makan, yang cara dan jenis makanannya diatur.
                    </p>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="assets/script_notif.js"></script>
</body>
</html>