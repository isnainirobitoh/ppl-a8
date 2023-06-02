<?php
require 'functions.php';

// ambil data di URL
$id = $_GET["id"];
// query data admin berdasarkan id
$adm = query("SELECT * FROM admin WHERE id = $id")[0];


if( isset($_POST["submit"]) ) {
   // cek apakah data berhasil diubah
   if (ubah($_POST) > 0 ) {
    echo "
    <script>
        alert('data berhasil diubah!');
        document.location.href = 'admin.php';
    </script>
    ";
   } else {
    echo "
    <script>
        alert('data gagal diubah!');
        document.location.href = 'admin.php';
    </script>
    ";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah data admin</title>
</head>
<body>
    <h1>Ubah data admin</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $adm["id"]; ?>">
        <ul>
            <li>
                <label for="nama">NAMA: </label>
                <input type="text" name="nama" id="nama" required 
                value="<?= $adm["nama"]; ?>">
            </li>
            <li>
                <label for="email">EMAIL: </label>
                <input type="text" name="email" id="email" required
                value="<?= $adm["email"]; ?>">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data</button>
            </li>
        </ul>
           
    </form>
</body>
</html>