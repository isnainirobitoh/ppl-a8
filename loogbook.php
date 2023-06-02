<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginCverif.php");
    exit;
}

$conn = mysqli_connect("localhost","root","","phpdasar"); 

// Cek koneksi
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil tanggal hari ini
$today = date("Y-m-d");

// Menghitung tanggal seminggu ke depan
$week_ago = date("Y-m-d", strtotime("0 days"));

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
  <title>LOGBOOK</title>
  <link rel="stylesheet" href="assets/stylenotif.css">

  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;@500;@600&display=swap" rel="stylesheet">
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
            font-weight: 600;
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
          margin-top: 1%;
          margin-bottom: 1%;
        }

        table, td{
          background-color: black;
          margin-left:auto;margin-right:auto;
          overflow-x: auto;
          font-weight: 400;
        }
        td {
          background-color: azure;
          text-align: justify;
          padding-left: 8px;
          padding-right: 8px;
        }
        th {
          background-color: darkgray;
        }
        input{
          float: center;
          border: 0;
          width: 80%;
        }
        button.btn-btn{
          color: black;
          background-color: antiquewhite;
          border-radius: 10px;
          width:10%;
          text-align: center;
          margin-left:auto;
          cursor: pointer;
          border: none;
          box-shadow: black;
          padding: 5px 10px 5px 10px;
          transition-duration: 0.4s; 
          margin-right: 3%;
          margin-top: 1%;
          position:fixed;
          left: 100px;
          top: 100px;
        }
        button.btn-btn:hover {
          background-color: burlywood;
        }
        .button-btn{
          color: black;
          background-color: antiquewhite;
          border-radius: 10px;
          width:10%;
          text-align: center;
          margin-left:auto;
          cursor: pointer;
          border: none;
          box-shadow: black;
          padding: 5px 10px 5px 10px;
          transition-duration: 0.4s; 
          margin-right: 3%;
          margin-top: 1%;
        }
        .button-btn:hover {
          background-color: burlywood;
        }
      </style>
</head>
<body style="background-color:#72a088;">
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

          <h2 class="mycss">LOGBOOK DIET PLAN</h2>
          <form method="post" action="update_checklist.php">
            <table style="width:85%">
              <tr>
                <th colspan="12">KEGIATAN</th>
              </tr>
            <?php
            echo "<tr>
            <th>Hari/Tanggal</th>
            <th>Waktu</th>
            <th>Saran Makanan (Sarapan)</th>
            <th>Checklist</th>
            <th>Waktu</th>
            <th>Saran Makan Siang</th>
            <th>Checklist</th>
            <th>Saran Olahraga</th>
            <th>Checklist</th>
            <th>Waktu</th>
            <th>Saran Makan Malam</th>
            <th>Checklist</th>
            </tr>";

            // Query untuk mengambil data dari tabel logbook
            $sql = "SELECT * FROM loogbook";
            $result = mysqli_query($conn, $sql);
              // Menampilkan data
            while ($row = mysqli_fetch_assoc($result)) {
            // Tampilkan tanggal pada baris pertama saja
              $tanggal = date("Y-m-d", strtotime($week_ago));
              $hari = date("l", strtotime($tanggal));
              echo "<tr>";
              echo "<td>" . date("d-m-Y", strtotime($tanggal)) . " (" . $hari . ")</td>";
                  echo "<td>" . $row['waktu_sarapan'] . "</td>";
                  echo "<td>" . $row['sarapan'] . "</td>";

                  echo "<td><input type='checkbox' name='checklist_sarapan[]' id='checklist' value='" . $row['id'] . "' onclick='updateChecklist(this)'" . ($row['checklist_sarapan'] == 1 ? " checked" : "") . "></td>";
                  echo "<td>" . $row['waktu_makan_siang'] . "</td>";
                  echo "<td>" . $row['makan_siang'] . "</td>";

                  echo "<td><input type='checkbox' name='checklist_makan_siang[]' id='checklist' value='" . $row['id'] . "' onclick='updateChecklist(this)'" . ($row['checklist_makan_siang'] == 1 ? " checked" : "") . "></td>";
                  echo "<td>" . $row['saran_olahraga'] . "</td>";

                  echo "<td><input type='checkbox' name='checklist_olahraga[]' id='checklist' value='" . $row['id'] . "' onclick='updateChecklist(this)'" . ($row['checklist_olahraga'] == 1 ? " checked" : "") . "></td>";
                  echo "<td>" . $row['waktu_makan_malam'] . "</td>";
                  echo "<td>" . $row['makan_malam'] . "</td>";

                  echo "<td><input type='checkbox' name='checklist_makan_malam[]' id='checklist' value='" . $row['id'] . "' onclick='updateChecklist(this)'" . ($row['checklist_makan_malam'] == 1 ? " checked" : "") . "></td>";
              echo "</tr>";
              // Hitung tanggal untuk hari berikutnya
              $week_ago = date("Y-m-d", strtotime($week_ago . " +1 day"));
            }
            // Menutup koneksi
            mysqli_close($conn);
            ?>
          </table>
          <button class="btn-btn" type="submit" name="submit">Update</button>
        </form>

        <?php
        echo '<p class="button-btn"><a href="dashboardC.php">Selesai</a></p>';
        ?>
        </div>

        <script>
        function updateChecklist(checklist_sarapan) {
          var value = checklist_sarapan.checked ? 1 : 0;
          var id = checklist_sarapan.value;

          // Kirim data ke server menggunakan AJAX
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "update_checklist.php");
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.send("id=" + id + "&value=" + value);

          console.log(id, value);
        }
        function updateChecklist(checklist_makan_siang) {
          var value = checklist_makan_siang.checked ? 1 : 0;
          var id = checklist_makan_siang.value;

          // Kirim data ke server menggunakan AJAX
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "update_checklist.php");
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.send("id=" + id + "&value=" + value);

          console.log(id, value);
        }
        function updateChecklist(checklist_olahraga) {
          var value = checklist_olahraga.checked ? 1 : 0;
          var id = checklist_olahraga.value;

          // Kirim data ke server menggunakan AJAX
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "update_checklist.php");
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.send("id=" + id + "&value=" + value);

          console.log(id, value);
        }
        function updateChecklist(checklist_makan_malam) {
          var value = checklist_makan_malam.checked ? 1 : 0;
          var id = checklist_makan_malam.value;

          // Kirim data ke server menggunakan AJAX
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "update_checklist.php");
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.send("id=" + id + "&value=" + value);

          console.log(id, value);
        }
      </script>
<script type="text/javascript" src="assets/script_notif.js"></script>
</body>
</html>
