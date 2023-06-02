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

$artikel = query("SELECT * FROM artikel")

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Artikel</title>
</head>
<body>
    <h1>Data Artikel</h1>
    <a href="tambahartikel.php">Tambah Data</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Deskripsi</th>

        </tr>
        <?php $i = 1;?>
        <?php foreach($artikel as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["judul"]; ?></td>
            <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
            <td><?= $row["deskripsi"]; ?></td>
           
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    
</body>
</html>