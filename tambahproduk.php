<?php
require 'functions.php';

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: loginMverif.php");
    exit;
}

if( isset($_POST["upload"]) ) {
    if(tambahproduk($_POST) > 0 ) {
        echo "
        <script type='text/javascript'>
            alert('Berhasil di Upload');
            window.location = 'marketplaceM.php';
        </script>
        ";
    } else {
        echo mysqli_error($conn);
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
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="assets/styletambahproduk.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

</head>
<body style="background-color:#72a088;">
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

        <div class="header">
            <h1>Tambah Produk</h1>
        </div>

        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>

                <div class="form-grup">
                    <div class="label">
                        <p>JENIS PRODUK</p>
                    </div>
                    <div class="input">
                        <input type="radio" name="jenisproduk" id="makanan" value="makanan"/>
                        <label for="makanan">Makanan</label><br>
                        <input type="radio" name="jenisproduk" id="minuman" value="minuman"/>
                        <label for="minuman">Minuman</label>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="namaproduk">NAMA PRODUK</label>
                    </div>
                    <div class="input">
                        <input type="text" name="namaproduk" placeholder="Masukkan Nama Produk" id="namaproduk" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="deskripsiproduk">DESKRIPSI PRODUK</label>
                    </div>
                    <div class="input">
                        <input type="text" name="deskripsiproduk" placeholder="Masukkan Deskripsi Produk" id="deskripsiproduk" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="gambarproduk">GAMBAR PRODUK</label>
                    </div>
                    <div class="input">
                        <input type="file" name="gambarproduk" placeholder="Masukkan Gambar Produk" id="gambarproduk" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="stok">Jumlah Produk</label>
                    </div>
                    <div class="input">
                        <input type="number" name="stok" placeholder="Masukkan Jumlah Produk" id="stok" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <div class="label">
                        <label for="hargaproduk">Harga Produk</label>
                    </div>
                    <div class="input">
                        <input type="text" name="hargaproduk" placeholder="Masukkan Harga Produk" id="hargaproduk" required/>
                    </div>
                </div>

                <div class="form-grup">
                    <!-- <button href="marketplaceM.php">Selesai</button> -->
                    <button type="submit" name="upload">Upload</button> 
                </div>

                </fieldset>
            </form>
        </div>

    </div>
    <script type="text/javascript" src="assets/script.js"></script>
</body>
</html>