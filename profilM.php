<?php
$conn = mysqli_connect("localhost","root","","phpdasar"); 

function query ($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginMverif.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>My Profil</title>
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
        .container{
            width: 100%;
            height: 100%;
            background-color: var(--bg-color);
            background-position: center;
            background-size: cover;
            box-sizing: border-box;
        }
        .header-profil{
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 2%;
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
        p img{
            width: 200px;
        }
    </style>

</head>
<body style="background-color:#72a088;">
    <div class="container-profilM">
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

        <div class="header-profil">
            <h2>Profil Saya</h2>
        </div>

        <div>
            <p class="pcss">Nama Pemilik Usaha: <?php echo $_SESSION['user']['namapemilikusaha']; ?></p>
            <p class="pcss">Tanggal Lahir: <?php echo $_SESSION['user']['tanggallahir']; ?></p>
            <p class="pcss">Nama Usaha: <?php echo $_SESSION['user']['namausaha']; ?></p>
            <p class="pcss">Deskripsi Usaha: <?php echo $_SESSION['user']['deskripsiusaha']; ?></p>
            <p class="pcss">Alamat Usaha: <?php echo $_SESSION['user']['alamatusaha']; ?></p>
            <p class="pcss">Alamat Kota Usaha: <?php echo $_SESSION['user']['kota']; ?></p>
            <p class="pcss">Alamat Provinsi Usaha: <?php echo $_SESSION['user']['provinsi']; ?></p>
            <p class="pcss">Nomor Telepon: <?php echo $_SESSION['user']['nomortelepon']; ?></p>
            <p class="pcss">Nama Bank: <?php echo $_SESSION['user']['namabank']; ?></p>
            <p class="pcss">Nomor Rekening: <?php echo $_SESSION['user']['nomorrekening']; ?></p>
            <p class="pcss">Gambar Bukti Usaha:  <img src="<?php echo $_SESSION['user']['gambarusaha']; ?>"></p>
            <p class="pcss">Email: <?php echo $_SESSION['user']['email']; ?></p>
        </div>

        <div class="btn-profil">
            <button><a href="edit_profilM.php">Edit Akun</a></button>
            <button><a href="dashboardM.php">Kembali</a></button>
    </div>

</body>
</html>