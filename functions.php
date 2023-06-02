<?php
// koneksi ke database
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

function tambah($data) {
    global $conn;
    // ambil data dari tiap elemen dalam form
     $nama = htmlspecialchars($data["nama"]);
     $email= htmlspecialchars($data["email"]);

     // query insert data
    $query = "INSERT INTO admin VALUES('', '$nama','$email')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM admin WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;
    $id = $data["id"];
    // ambil data dari tiap elemen dalam form
    $nama = htmlspecialchars($data["nama"]);
    $email= htmlspecialchars($data["email"]);

     // query insert data
    $query = "UPDATE admin SET 
                nama = '$nama', 
                email = '$email' 
            WHERE id = $id
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function registrasimitra($data) {
    global $conn;
    
    $namapemilikusaha = htmlspecialchars($data["namapemilikusaha"]);
    $tanggallahir = $data["tanggallahir"];
    $namausaha = htmlspecialchars($data["namausaha"]);
    $deskripsiusaha = htmlspecialchars($data["deskripsiusaha"]);
    $alamatusaha = htmlspecialchars($data["alamatusaha"]);
    $kota = htmlspecialchars($data["kota"]);
    $provinsi = htmlspecialchars($data["provinsi"]);
    $nomortelepon = htmlspecialchars($data["nomortelepon"]);
    $namabank = htmlspecialchars($data["namabank"]);
    $nomorrekening = htmlspecialchars($data["nomorrekening"]);
    $gambarusaha = $_FILES["gambarusaha"];
    $email= htmlspecialchars($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $file_tmp = $gambarusaha['tmp_name'];
    $file_name = $gambarusaha['name'];
    $file_dest = 'file/'.$file_name;
    move_uploaded_file($file_tmp, $file_dest);

    // cek email sudah ada atau belum
    $result = mysqli_query($conn, "SELECT email FROM mitra WHERE email = '$email' ");
    if( mysqli_fetch_assoc($result) > 0) {
        echo "
        <script type='text/javascript'>
            alert('Data sudah pernah digunakan!');
            window.history.back();
        </script>
        ";
        return false;
    } else{
        echo "
        <script type='text/javascript'>
            alert('Berhasil mendaftar!');
            window.location='dashboardM.php';
        </script>
        ";
    }

    //cek konfirmasi password
    if( $password !== $password2 ) {
        echo "
        <script>
            alert('Password dan Konfirmasi Password Harus Sama');
        </script>
        ";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    // tambahkan user ke database
    $query = "INSERT INTO mitra VALUES('', '$namapemilikusaha', '$tanggallahir', '$namausaha', '$deskripsiusaha', '$alamatusaha', '$kota', '$provinsi',
                '$nomortelepon', '$namabank', '$nomorrekening', '$file_dest', '$email', '$password')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahproduk($data){
    global $conn;

    $id_mitra = $_SESSION["user"]["id"];
    $jenisproduk = $data["jenisproduk"];
    $namaproduk = htmlspecialchars($data["namaproduk"]);
    $deskripsiproduk = htmlspecialchars($data["deskripsiproduk"]);
    $gambarproduk = $_FILES["gambarproduk"];
    $stok = $data["stok"];
    $hargaproduk = $data["hargaproduk"];

    $file_tmp = $gambarproduk['tmp_name'];
    $file_name = $gambarproduk['name'];
    $file_dest = 'produk/'.$file_name;
    move_uploaded_file($file_tmp, $file_dest);

    $query = "INSERT INTO produk(jenis_produk, nama_produk, deskripsi_produk, gambar_produk, stok, harga_produk, id_mitra)
                VALUES('$jenisproduk', '$namaproduk', '$deskripsiproduk', '$file_dest', '$stok', '$hargaproduk', '$id_mitra')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function tambahpesan($data) {
    global $conn;

    $jumlahpesanan = $data["jumlahpesanan"];
    $alamatpengiriman = $data["alamatpengiriman"];
    $kodepos = $data["kodepos"];
    $notelp = $data["notelp"];
    // Mendapatkan tanggal dan waktu saat ini
    $tanggal_pemesanan = date('Y-m-d');
    $waktu_pemesanan = date('H:i:s');
    $id_customer = $_SESSION["user"]["id"];
    $id_produk = $_GET['id']; 

    // Mengambil jumlah stok produk sebelum diupdate
    $query_produk = "SELECT stok FROM produk WHERE id = $id_produk";
    $result_produk = mysqli_query($conn, $query_produk);
    $row_produk = mysqli_fetch_assoc($result_produk);
    $stok_sebelum = $row_produk['stok'];

    // Cek apakah stok cukup
    if ($jumlahpesanan > $stok_sebelum) {
        // Stok tidak cukup, tidak dapat memproses pemesanan
        echo "
         <script type='text/javascript'>
             alert('Jumlah pesanan Anda melebihi stok produk!');
         </script>
         ";
        return false;
    }

    // Menghitung jumlah stok setelah dikurangi dengan pesanan
    $stok_setelah = $stok_sebelum - $jumlahpesanan;

    // Mengambil informasi harga produk
    $query_harga = "SELECT harga_produk FROM produk WHERE id = $id_produk";
    $result_harga = mysqli_query($conn, $query_harga);
    $row_harga = mysqli_fetch_assoc($result_harga);
    
    // Mengonversi nilai menjadi tipe data numerik
    $harga_produk = floatval($row_harga['harga_produk']);
    $jumlahpesanan = intval($data["jumlahpesanan"]);

    // Menghitung total harga
    $total_harga = $harga_produk * $jumlahpesanan;

    // Update jumlah stok produk di database
    $query_update_stok = "UPDATE produk SET stok = $stok_setelah WHERE id = $id_produk";
    mysqli_query($conn, $query_update_stok);

    // Insert data pemesanan ke tabel pemesanan
    $query_insert = "INSERT INTO pemesanan(jumlah_pesanan, alamat_pengiriman, kode_pos, no_telp, tanggal_pemesanan, waktu_pemesanan, id_customer, id_produk)
                VALUES('$jumlahpesanan', '$alamatpengiriman', '$kodepos', '$notelp', '$tanggal_pemesanan', '$waktu_pemesanan','$id_customer', '$id_produk')";
    mysqli_query($conn, $query_insert);

    // Mendapatkan ID pemesanan terakhir yang baru saja diinsert
    $last_insert_id = mysqli_insert_id($conn);

    // Redirect pengguna ke halaman pembayaran dengan parameter URL
    header("Location: pembayaran.php?id_pemesanan=$last_insert_id&total_harga=$total_harga");
    exit();

    return mysqli_affected_rows($conn);
}

function buktipembayaran($data) {
    global $conn;

    $uploadbukti = $_FILES["uploadbukti"];

    $file_tmp = $uploadbukti['tmp_name'];
    $file_name = $uploadbukti['name'];
    $file_dest = 'pembayaran/'.$file_name;
    move_uploaded_file($file_tmp, $file_dest);
    
    $id_pemesanan = $_GET['id_pemesanan']; 

    $query = "UPDATE pemesanan SET bukti_pembayaran = '$file_dest' WHERE id = $id_pemesanan";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

?>