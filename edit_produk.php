<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginMverif.php");
    exit;
}

if( !isset($_SESSION["produk"]) ) {
    header("Location: marketplaceM.php");
    exit;
}

$_SESSION["produk"] = true;

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

if (isset($_POST['submit'])) {
    $jenisproduk = $_POST['jenisproduk'];
    $namaproduk = $_POST['namaproduk'];
    $deskripsiproduk = $_POST['deskripsiproduk'];
    $gambarproduk = $_FILES['gambarproduk'];
    $stok = $_POST["stok"];
    $hargaproduk = $_POST["hargaproduk"];

    $file_tmp = $gambarproduk['tmp_name'];
    $file_name = $gambarproduk['name'];
    $file_dest = 'produk/'.$file_name;
    move_uploaded_file($file_tmp, $file_dest);
  
    $query = "UPDATE produk SET jenis_produk = '$jenisproduk', nama_produk = '$namaproduk', deskripsi_produk = '$deskripsiproduk', 
                gambar_produk = '$file_dest', stok = '$stok', harga_produk = '$hargaproduk' WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
  
    if ($result) {
      $_SESSION['produk'] = [
        'id' => $id,
        'jenis_produk' => $jenisproduk,
        'nama_produk' => $namaproduk,
        'deskripsi_produk' => $deskripsiproduk,
        'gambar_produk' => $file_dest,
        'stok' => $stok,
        'harga_produk' => $hargaproduk
      ];
      echo "<script type='text/javascript'>
      alert('Berhasil Diubah');
      window.location='marketplaceM.php';
      </script>";
      exit;
    } else {
      $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <title>Edit Produk</title>

    <link rel="stylesheet" href="assets/styleeditproduk.css">
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
                    <li><a href="dashboardM.php">BERANDA</a></li>
                    <li><a href="artikelM.php">ARTIKEL</a></li>
                    <li><a href="marketplaceM.php">MARKETPLACE</a></li>
                    <li><a href="profilM.php" class="user"><i class="ri-user-3-fill"></i></a></li>
                    <li><a href="logout.php">LOGOUT<i class="ri-logout-box-r-fill"></i></a></li>
                </ul>
            </nav>
        </div>

        <h1>EDIT PRODUK</h1>

        <?php if (isset($error)): ?>
        <p>Gagal mengubah produk.</p>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data">
            <?php
            $query = "SELECT * FROM produk WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $jenisproduk = $row['jenis_produk']; //
            }
            ?>

            <label>Jenis Produk:</label>
            <input class="jenis" type="radio" name="jenisproduk" id="makanan" value="makanan" <?php if ($jenisproduk == 'makanan') echo "checked"; ?>> Makanan
            <br>
            <input class="jenis" type="radio" name="jenisproduk" id="minuman" value="minuman" <?php if ($jenisproduk == 'minuman') echo "checked"; ?>> Minuman



            <label for="namaproduk">Nama Produk:</label>
            <input type="text" name="namaproduk" id="namaproduk" value="
            <?php 
            $query = "SELECT * FROM produk WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo $row['nama_produk'];
            } 
            ?>" required>

            <label for="deskripsiproduk">Deskripsi Produk:</label>
            <input type="text" name="deskripsiproduk" id="deskripsiproduk" value="
            <?php 
            $query = "SELECT * FROM produk WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo $row['deskripsi_produk'];
            } 
            ?>" required>

            <label for="gambarproduk">Gambar Produk:</label>
            <input type="file" name="gambarproduk" id="gambarproduk" value="
            <?php 
            $query = "SELECT * FROM produk WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo $row['gambar_produk'];
            } 
            ?>" required>

            <label for="stok">Jumlah Produk:</label>
            <input type="number" name="stok" id="stok" value="
            <?php 
            $query = "SELECT * FROM produk WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo $row['stok'];
            } 
            ?>" required>

            <label for="hargaproduk">Harga Produk:</label>
            <input type="text" name="hargaproduk" id="hargaproduk" value="
            <?php 
            $query = "SELECT * FROM produk WHERE id = $id";
            $result = mysqli_query($koneksi, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo $row['harga_produk'];
            } 
            ?>" required>
            
            <br>
            <button type="submit" name="submit">Upload</button>
        </form>

    </div>
    <script type="text/javascript" src="assets/script.js"></script>
</body>
</html>