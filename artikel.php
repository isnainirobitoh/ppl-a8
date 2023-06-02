<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

$_SESSION["artikel"] = true;

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
    echo "Error executing query: " . mysqli_error($conn);
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
    <title>ARTIKEL</title>
    <link rel="stylesheet" href="assets/stylenotif.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        list-style: none;
    }
    h1{
        margin-top: 2%;
        margin-bottom: 2%;
        text-align: center;
        font-size: 40px;
        text-shadow: 2px 2px 5px rgb(246, 250, 251);
    }
    img{
        align-items: center;
        display: inline-block;
        border-radius: 10px;
        box-sizing: border-box;
        position: center;
        size: cover;
        margin-left: 30%;
        transition: transform 0.5s;
    }
    img:hover{
        transform: translateY(-10px);
    }
    .row{
        display: flex;
        height: 88%;
        align-items: center;
    }
    .col{
        float: center;
        padding: 10px;
    }
    .row{
        display: flex;
        height: 88%;
        align-items: center;
    }
    .left {
        width: 40%;
        align-items: center;
    }
    .right {
        width: 80%;
    }
    .pcss{
        text-decoration: none;
    }
    li{
        list-style: none;
        margin-bottom: 15px;
        font-size: 14px;   
    }
    h2{
        text-decoration: none;
        color: #edf3ee;
    }
    button{
        background-color: #ecd27b; color: black;
        border: none;
        border-radius: 20px;
        outline: none;
        font-size: 12px;
        padding: 5px 15px 5px 15px;
        transition-duration: 0.4s; 
        cursor: pointer;
    }
    button:hover {
        background-color: #527454; 
        color: white; 
    }
    .logo{
        display: flex;
        padding: 3vh 3vw;
        text-align: left;
        width: 20vw;
        cursor: pointer;
        align-items: center;
    }
    .logo i{
        color:#edf3ee;
        font-size: 28px;
        margin-right: 3px;
    }
    .logo span{
        color:#0b0a0a;
        font-size: 1.1rem;
        font-weight: 600;
    }
    .navbar{
        height: 12%;
        display: flex;
        align-items: center;
        padding-left: 8%;
        padding-right: 8%;
        box-sizing: border-box;
        background-color: #acd8ba;
    }
    .menu-icon{
        font-size: 20px;
        cursor: pointer;
        z-index: 10001;
        display: none;
    }
    nav{
        flex: 1;
        text-align: right;
    }
    .navbar a:hover{
        color:#edf3ee;
    } 
    nav ul li {
        list-style: none;
        display: inline-block;
        margin-left: 60px;
    }
    nav ul li a{
        text-decoration: none;
        color: #0b0a0a;
        font-size: 15px;
    }
    </style>
</head>
<body style="background-color: #72a088;">
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
    <h1>ARTIKEL</h1>
    <div class="row">
        <div class="col left">
            <h5><img src="images/artikel.jpg" width="250px"></h5>
        </div>
        <div class="col right">
            <p class="pcss">
            <?php
            // Query untuk menampilkan daftar artikel
            $query = "SELECT * FROM artikel";
            $result = mysqli_query($koneksi, $query);

            // Menampilkan daftar artikel dalam bentuk HTML
            while ($row = mysqli_fetch_assoc($result)) { 
                echo "<li>";
                echo "<h2>" . $row['judul'] . "</h2>";
                echo "<form method='get' action='detail_artikel.php'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit'>Show</button>";
                echo "</form>";
                echo "</li>";
            } 

            // Tutup koneksi
            mysqli_close($koneksi);
            ?>
            </p>
        </div>
    </div> 
    <script type="text/javascript" src="assets/script_notif.js"></script>
</body>
</html>