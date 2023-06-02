<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

$conn = mysqli_connect("localhost","root","","phpdasar"); 
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
    <title>Hasil Konsultasi</title>
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
        :root{
            --bg-color: #72a088;
            --text-color: #0b0a0a;
            --main-color: #edf3ee;
            --title-color: #E1D5B8;
            --nav-color: #acd8ba;
        }
        .container{
            width: 100%;
            height: 100vh;
            background-color: var(--bg-color);
            background-position: center;
            background-size: cover;
            box-sizing: border-box;
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
            color:var(--text-color);
            font-size: 28px;
            margin-right: 3px;
        }
        .logo span{
            color:var(--text-color);
            font-size: 1.1rem;
            font-weight: 600;

        }
        .navbar{
            height: 12%;
            display: flex;
            align-items: center;
            background-color: var(--nav-color);
            padding-left: 5%;
            padding-right: 5%;
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
            color:var(--main-color);
        } 
        nav ul li {
            list-style: none;
            display: inline-block;
            margin-left: 60px;
        }
        nav ul li a{
            text-decoration: none;
            color: var(--text-color);
            font-size: 15px;
        }
        .mycss{
            color:beige;
            font-size: 32px;
            text-align: center;
            margin-top: 3%;
           
        }
        .pcss{
            color:black;
            font-size: 14px;
            text-align: justify;
            border: 1px solid black;
            border-radius: 5px;
            background-color: white;
            padding-top: 8px;
            padding-right: 8px;
            padding-bottom: 8px;
            padding-left: 20px;
            margin-top: 3%;
            display: flex;
        }
        .row{
            display: flex;
            height: 88%;
            align-items: center;
            margin-top: -10%;
        }
        .col{
            float: center;
            padding: 10px;
        }
        .left {
            width: 40%;
            align-items: center;
        }
        .right {
            width: 40%;
        }
        .acss{
            margin-top: 3%;
        }
        .acss a{
            text-decoration: none;
            font-family: 'Poppins';
            font-size: 16px;
            background-color: #ecd27b; color: black;
            border: none;
            border-radius: 20px;
            outline: none;
            font-size: 12px;
            padding: 10px 15px 10px 15px;
            transition-duration: 0.4s; 
            cursor: pointer;
        }
        .acss a:hover{
            background-color: #527454; 
            color: white; 
            border-color: bisque;
        }
        .apcss{
            margin-top: 30%;
        }
        .apcss a{
            text-decoration: none;
            font-family: 'Poppins';
            font-size: 16px;
            background-color: #ecd27b; color: black;
            border: none;
            border-radius: 20px;
            outline: none;
            font-size: 12px;
            padding: 10px 15px 10px 15px;
            transition-duration: 0.4s; 
            cursor: pointer;
        }
        .apcss a:hover{
            background-color: #527454; 
            color: white; 
            border-color: bisque;
        }
        img{
            width: 50%;
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
    </style>
</head>
<body style="background-color: #72a088;">
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

        <h2 class="mycss">HASIL KONSULTASI</h2>

        <div class="row">
        <div class="col left">
            <img src="images/hasilkonsul.jpg">
        </div>

        <div class="col right">
            <p>
            <?php
            $id_customer = $_SESSION["user"]["id"];

            $conn = mysqli_connect("localhost","root","","phpdasar"); 

            // Ambil data tinggi badan dan berat badan dari database
            $query = "SELECT umur, beratbadan, tinggibadan, jeniskelamin FROM konsultasi WHERE id_customer = $id_customer ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $umur = $row['umur'];
            $beratbadan = $row['beratbadan'];
            $tinggibadan = $row['tinggibadan'];
            $jeniskelamin = $row['jeniskelamin'];

            // Hitung berat badan ideal
            $berat_badan_ideal = ($tinggibadan - 100) - 10/100;

            // Hitung min kalori
            if( $jeniskelamin == 'Perempuan') {
                $min_kalori = $berat_badan_ideal * 25;
            } else if ( $jeniskelamin == 'Laki-laki') {
                $min_kalori = $berat_badan_ideal * 30;
            }

            // Hitung normal kalori
            if( $jeniskelamin == 'Perempuan') {
                $normal_kalori = 66.5 + (13.75 * $beratbadan) + (5 * $tinggibadan) - (6.75 * $umur);
            } else if ( $jeniskelamin == 'Laki-laki') {
                $normal_kalori = 655.1 + (9.563 * $beratbadan) + (1.850 * $tinggibadan) - (4.676 * $umur);
            }

            // Hitung max kalori
            $max_kalori = ($normal_kalori * 10/100) + $normal_kalori ;

            // Menampilkan hasil perhitungan
            echo '<p class="pcss">Berat Badan Ideal: ' . ($berat_badan_ideal) . ' kg</p>';
            echo '<p class="pcss">Minimum Jumlah Kalori yang Dikonsumsi Perhari: '. $min_kalori .' kkal<p>';
            echo '<p class="pcss">Maksimal Jumlah Kalori yang Dikonsumsi Perhari: '. $max_kalori .' kkal<p>';
            echo '<p class="pcss">Normal Jumlah Kalori yang Dikonsumsi Perhari: '. $normal_kalori .' kkal<p>';

            echo '<p class="acss"><a href="loogbook.php">LOGBOOK DIET PLAN</a></p>';
            echo '<p class="acss"><a href="edit_konsultasi.php">EDIT KONSULTASI</a></p>';

            ?>
            </p>
        </div>
        <p class="apcss"><a href="dashboardC.php">Kembali</a></p>
        </div>        
    </div>
    
    
    <script type="text/javascript" src="assets/script_notif.js"></script>
</body>
</html>