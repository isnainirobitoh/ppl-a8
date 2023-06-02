<?php
require 'functions.php';

if( isset($_POST["submit"]) ) {
   // cek apakah data berhasil ditambahkan
   if (tambah($_POST) > 0 ) {
    echo "
    <script>
        alert('data berhasil ditambahkan!');
        document.location.href = 'admin.php';
    </script>
    ";
   } else {
    echo "
    <script>
        alert('data gagal ditambahkan!');
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
    <title>Tambah data admin</title>
</head>
<body>
    <h1>Tambah data admin</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="nama">NAMA: </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="email">EMAIL: </label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
           
    </form>
</body>
</html>