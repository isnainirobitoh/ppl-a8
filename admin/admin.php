<?php
require 'functions.php' ;
$admin = query("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>

<h1>Daftar Admin</h1>

<a href="tambah.php">Tambah data admin</a>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No</th>
        <th>Aksi</th>
        <th>Nama</th>
        <th>Email</th>
    </tr>

    <?php $i = 1;?>
    <?php foreach($admin as $row) : ?>
    <tr>
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"]; ?>">Update</a> |
            <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="
                return confirm('yakin?');">Delete</a>
        </td>
        <td><?= $row["nama"]; ?></td>
        <td><?= $row["email"]; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>

</table>

</body>
</html>