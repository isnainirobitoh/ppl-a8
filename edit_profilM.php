<?php
session_start();
require 'functions.php';

if( !isset($_SESSION["login"]) ) {
    header("Location: loginMverif.php");
    exit;
}

$id = $_SESSION['user']['id'];

$query = mysqli_query($conn, "SELECT * FROM mitraa WHERE id = $id");
$user = mysqli_fetch_assoc($query);

if (isset($_POST['submit'])) { 
    $namapemilikusaha = $_POST['namapemilikusaha'];
    $tanggallahir = $_POST['tanggallahir'];
    $namausaha = $_POST['namausaha'];
    $deskripsiusaha = $_POST['deskripsiusaha'];
    $alamatusaha = $_POST['alamatusaha'];
    $kota = $_POST['kota'];
    $provinsi = $_POST['provinsi'];
    $nomortelepon = $_POST['nomortelepon'];
    $namabank = $_POST['namabank'];
    $nomorrekening = $_POST['nomorrekening'];
    $gambarusaha = $_FILES["gambarusaha"];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $file_tmp = $gambarusaha['tmp_name'];
    $file_name = $gambarusaha['name'];
    $file_dest = 'file/'.$file_name;
    move_uploaded_file($file_tmp, $file_dest);
  
    $query = "UPDATE mitraa SET namapemilikusaha = '$namapemilikusaha', tanggallahir = '$tanggallahir', namausaha = '$namausaha', 
        deskripsiusaha = '$deskripsiusaha', alamatusaha = '$alamatusaha', kota = '$kota', provinsi = '$provinsi', nomortelepon = '$nomortelepon', 
        namabank = '$namabank', nomorrekening = '$nomorrekening', gambarusaha = '$file_dest', email = '$email' WHERE id = $id";
    $result = mysqli_query($conn, $query);
  
    if ($result) {
      $_SESSION['user'] = [
        'id' => $id,
        'namapemilikusaha' => $namapemilikusaha,
        'tanggallahir' => $tanggallahir,
        'namausaha' => $namausaha,
        'deskripsiusaha' => $deskripsiusaha,
        'alamatusaha' => $alamatusaha,
        'kota' => $kota,
        'provinsi' => $provinsi,
        'nomortelepon' => $nomortelepon,
        'namabank' => $namabank,
        'nomorrekening' => $nomorrekening,
        'gambarusaha' => $file_dest,
        'email' => $email
      ];
      
      echo "<script type='text/javascript'>
      alert('Berhasil Diubah');
      window.location='edit_profilM.php';
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
    <title>Edit Akun</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        h1{
            color: rgb(22, 29, 50);
            font-family: 'Poppins';
            font-weight: bold;
            text-align: center;
            text-shadow: 2px 2px 5px rgb(246, 250, 251);
        }
        body{
            background: linear-gradient(115deg, #3b805c 10%, #5472ad 90%); 
            width: 100%;
            height: 100vh;
        }
        form{
            margin-bottom: 20px;
            margin-right: 20px;
            margin-left: 20px;
            padding-left: 3%;
            padding-right: 3%;
            padding-top: 3%;
            padding-bottom: 3%;
            border-radius: 5px;
            display: table;
            background-color: #fff;
            margin: 0 auto;
            width: 60%;
        }
        label{
            float: left;
            width: 30%;
            border: 0;
            font-weight: 900; 
            color: #14161a;
            font-size: 14px;
            font-family: 'Poppins';
            margin-top: 15px;
            text-transform: uppercase;
        }
        .label label{
	        display: inline-block;
            vertical-align: -webkit-baseline-middle;
        }
        input{
	        float: left;
	        width: 70%;
	        border: 0;
            margin-top: 10px;
        }
        input[type=text], input[type=date], input[type=email], input[type=password], input[type=file], textarea{
            border: 2px solid #bfbbbb;
            padding: 9px;
            border-radius: 10px;
            background: #fff;
            width: 50%;
            font-family: Arial, Helvetica, sans-serif; 
            background-color: #d9f1c2;
            color: #131313;
        }
        input[type=text]:focus, input[type=email]:focus, input[type=password], textarea:focus{
            border:2px solid #87bed8;
        }
        button{
            background-color: #ecd27b; color: black;
            border: none;
            font-size: 12px;
            padding: 10px 15px 10px 15px; 
            border-radius: 8px; 
            transition-duration: 0.4s;
            cursor: pointer;
            float: right;
            font-family: 'Poppins';
            margin-top: 20px;
            margin-left: 10px;
            width: 20%;
        }
        button:hover {
            background-color: #3b805c; 
            color: white; 
        }
    </style>

</head>
<body>
<h1>EDIT AKUN</h1>

  <?php if (isset($error)): ?>
    <p>Gagal mengubah profil.</p>
  <?php endif; ?>

  <form action="" method="post" enctype="multipart/form-data">
    <label for="namapemilikusaha">Nama Pemilik Usaha:</label>
    <input type="text" name="namapemilikusaha" id="namapemilikusaha" value="<?php echo $user['namapemilikusaha'] ?>" required>

    <label for="tanggallahir">Tanggal Lahir:</label>
    <input type="date" name="tanggallahir" id="tanggallahir" value="<?php echo $user['tanggallahir'] ?>" required>

    <label for="namausaha">Nama Usaha:</label>
    <input type="text" name="namausaha" id="namausaha" value="<?php echo $user['namausaha'] ?>" required>

    <label for="deskripsiusaha">Deskripsi Usaha:</label>
    <input type="text" name="deskripsiusaha" id="deskripsiusaha" value="<?php echo $user['deskripsiusaha'] ?>" required>

    <label for="alamatusaha">Alamat Usaha:</label>
    <input type="text" name="alamatusaha" id="alamatusaha" value="<?php echo $user['alamatusaha'] ?>" required>

    <label for="kota">Alamat Kota Usaha:</label>
    <input type="text" name="kota" id="kota" value="<?php echo $user['kota'] ?>" required>

    <label for="provinsi">Alamat Provinsi Usaha:</label>
    <input type="text" name="provinsi" id="provinsi" value="<?php echo $user['provinsi'] ?>" required>

    <label for="nomortelepon">Nomor Telepon:</label>
    <input type="text" name="nomortelepon" id="nomortelepon" value="<?php echo $user['nomortelepon'] ?>" required>

    <label for="namabank">Nama Bank:</label>
    <input type="text" name="namabank" id="namabank" value="<?php echo $user['namabank'] ?>" required>

    <label for="nomorrekening">Nomor Rekening:</label>
    <input type="text" name="nomorrekening" id="nomorrekening" value="<?php echo $user['nomorrekening'] ?>" required>

    <label for="gambarusaha">Gambar Bukti Usaha:</label>
    <input type="file" name="gambarusaha" id="gambarusaha" value="<?php echo $user['gambarusaha'] ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $user['email'] ?>" required>

    <br>
    <button><a href = "dashboardM.php">Kembali</a></button>
    <br>
    <button type="submit" name="submit">SIMPAN DATA</button>
  </form>
</body>
</html>