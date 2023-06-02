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

function tambahartikel($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form
     $judul = htmlspecialchars($data["judul"]);
     $gambar = $_FILES["gambar"];
     $deskripsi= htmlspecialchars($data["deskripsi"]);
     
     $file_tmp = $gambar['tmp_name'];
     $file_name = $gambar['name'];
     $file_dest = 'imgartikel/'.$file_name;
     move_uploaded_file($file_tmp, $file_dest);

     // query insert data
    $query = "INSERT INTO artikel VALUES('', '$judul','$file_dest','$deskripsi')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

if( isset($_POST["submit"]) ) {
    // cek apakah data berhasil ditambahkan
    if (tambahartikel($_POST) > 0 ) {
     echo "
     <script>
         alert('data berhasil ditambahkan!');
     </script>
     ";
    } else {
     echo "
     <script>
         alert('data gagal ditambahkan!');
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
    <title>Tambah Artikel</title>
</head>
<body>
    <h1>Tambah data artikel</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="judul">Judul : </label>
                <input type="text" name="judul" id="judul"></input>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar"></input>
            </li>
            <li>
                <label for="deskripsi">Deskripsi : </label>
                <input type="text" name="deskripsi" id="deskripsi"></input>
            </li>
            <li>
                <button type="submit" name="submit">Tambah Data</button>
            </li>
        </ul>
    </form>
</body>
</html>