<?php
require 'koneksi.php';

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

$userId = $_SESSION['user']['id'];
$query_role = "SELECT role FROM user_roles WHERE id = $userId";
$result_role = mysqli_query($conn, $query_role);

if ($result_role) {
    $row = mysqli_fetch_assoc($result_role);
    $userRole = $row['role'];
} else {
    echo "Error executing query: " . mysqli_error($conn);
}

$query_konsultasi = "SELECT id_customer FROM konsultasi WHERE id_customer = $userId";
$result_konsultasi = mysqli_query($conn, $query_konsultasi);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>My Profil</title>
    <link rel="stylesheet" href="assets/stylenotif.css">
    <link rel="stylesheet" type="text/css" href="assets/styledashboard.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet"href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        *{
            text-decoration: none;
        }
        .header-profil{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 5%;
            margin-bottom: 2%;
        }
        .pcss{
            color:black;
            font-size: 14px;
            text-align: justify;
            margin-top: 8px;
            margin-left: 28%;
            border-radius: 6px;
            background-color: white;
            padding-top: 8px;
            padding-right: 8px;
            padding-bottom: 8px;
            padding-left: 20px;
            width: 50%;
            display: flex;
            align-items: center;
        }
        button:hover{
            color:#131313;
            background-color: #fff;
        }
        .btn-profil{
            display: flex;
            align-items: center;
            justify-content: center;
            transition-duration: 0.4s;
        }
        .btn-profil button{
            margin-left: 10px;
            width: 180px;
            color:#000;
            font-size: 12px;
            padding: 12px 0;
            background-color: var(--title-color);
            border: 0;
            border-radius: 20px;
            outline: none;
            margin-top: 30px;
            cursor: pointer;
        }

    </style>

</head>
<body style="background-color:#C5F6E4;">
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
        <div class="header-profil">
            <h2>Profil Saya</h2>
        </div>
        <p class="pcss">Email: <?php echo $_SESSION['user']['email']; ?></p>
        <p class="pcss">Nama Lengkap: <?php echo $_SESSION['user']['namalengkap']; ?></p>
        <p class="pcss">Tanggal Lahir: <?php echo $_SESSION['user']['tanggallahir']; ?></p>

        <div class="btn-profil">
            <button><a href="edit_profil.php">Edit Akun</a></button>
            <button><a href="dashboardC.php">Kembali</a></button>
        </div>
       
        
    </div>
    <script type="text/javascript" src="assets/script_notif.js"></script>
</body>
</html>