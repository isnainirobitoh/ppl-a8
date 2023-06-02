<?php
session_start();

if( !isset($_SESSION["artikel"]) ) {
    header("Location: artikelM.php");
    exit;
}
$id = $_GET['id']; // Ambil ID artikel dari URL

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

// Query untuk menampilkan artikel berdasarkan ID
$query = "SELECT * FROM artikel WHERE id = $id";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Show Artikel</title>

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
            font-family: 'Poppins';
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
            width: 100%;
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
        h2{
            font-size: 36px;
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
            font-family: 'Poppins';
            text-transform: uppercase;
            text-align: center;
            text-shadow: 2px 2px 5px rgb(246, 250, 251);
        }
        p {
            font-size: 14px;
            line-height: 1.5;
            color: #edf3ee;
            margin-top: 10px;
            margin-bottom: 20px;
            font-family: 'Poppins';
            text-align: justify;
            margin-left: 50px;
            margin-right: 50px;
            padding-left: 8%;
            padding-right: 8%;
        }
        img {
            max-width: 30%;
            height: auto;
            margin-bottom: 20px;
            align-items: center;
            margin-left:auto;margin-right:auto;display:block;
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
            font-family: 'Poppins';
            float: right;
            margin-bottom: 5%;
            margin-right: 5%;
        }
        button:hover {
            background-color: #fff; 
            color: white; 
        }
        a{
            text-decoration: none;
        }
        
    </style>
</head>
<body  style="background-color: #6A9E86;">
<diiv class="container">

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

    <?php
    // Tampilkan artikel dalam bentuk HTML
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<h2>" . $row['judul'] . "</h2>";
        echo "<img src='" . $row['gambar'] . "'>";
        echo "<p>" . $row['deskripsi'] . "</p>";
    
    } else {
        echo "Artikel tidak ditemukan";
    }
    
    // Tutup koneksi
    mysqli_close($koneksi);
    ?>
    <button><a href="artikelM.php">Kembali</a></button>
</div>
</body>
</html>