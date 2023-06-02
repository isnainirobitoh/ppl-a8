<?php
// Buat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "phpdasar");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Gagal terhubung ke MySQL: " . mysqli_connect_error();
    exit();
}

// Periksa apakah ada data yang dikirim melalui metode POST
if (isset($_POST['id'])) {
    // Ambil ID pemesanan dari data yang dikirim
    $id = $_POST['id'];

    // Mengambil waktu pemesanan dari data yang dikirim
    $query_waktu_pemesanan = "SELECT waktu_pemesanan FROM pemesanan WHERE id = $id";
    $result_waktu_pemesanan = mysqli_query($koneksi, $query_waktu_pemesanan);
    $row_waktu_pemesanan = mysqli_fetch_assoc($result_waktu_pemesanan);
    $waktu_pemesanan = $row_waktu_pemesanan['waktu_pemesanan'];

    // Mendapatkan waktu saat ini
    $waktu_sekarang = date('H:i:s');

    // Menghitung selisih waktu
    $selisih_waktu = strtotime($waktu_sekarang) - strtotime($waktu_pemesanan);
    $selisih_jam = floor($selisih_waktu / (60 * 60));

    // Periksa apakah selisih waktu lebih dari 2 jam
    if ($selisih_jam <= 2) {
        // Waktu pemesanan tidak lebih dari 2 jam, melakukan penghapusan pesanan

        // Mengambil jumlah_pesanan yang akan dihapus
        $query_jumlah_pesanan = "SELECT jumlah_pesanan, id_produk FROM pemesanan WHERE id = $id";
        $result_jumlah_pesanan = mysqli_query($koneksi, $query_jumlah_pesanan);
        $row_jumlah_pesanan = mysqli_fetch_assoc($result_jumlah_pesanan);
        $jumlah_pesanan = $row_jumlah_pesanan['jumlah_pesanan'];
        $id_produk = $row_jumlah_pesanan['id_produk'];

        // Mengupdate nilai jumlah_pesanan pada tabel produk
        $query_update_produk = "UPDATE produk SET stok = stok + $jumlah_pesanan WHERE id = $id_produk";
        mysqli_query($koneksi, $query_update_produk);
    
        // Query untuk menghapus data pemesanan berdasarkan ID
        $query = "DELETE FROM pemesanan WHERE id = $id";
        $result = mysqli_query($koneksi, $query);

        // Periksa apakah penghapusan berhasil
        if ($result) {
            // echo "Pemesanan berhasil dibatalkan.";
            echo "
            <script type='text/javascript'>
                alert('Pesanan berhasil dibatalkan! Silakan refund pembayaran Anda melalui WhatsApp di https://wa.me/6282334492141');
                window.location.href = 'pesananC.php';
            </script>
            ";
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }

    } else {
        // Waktu pemesanan lebih dari 2 jam, tampilkan pesan error
        echo "
        <script type='text/javascript'>
            alert('Pesanan Anda tidak dapat dibatalkan! Waktu pemesanan sudah melebihi batas 2 jam.');
            window.location.href = 'pesananC.php';
        </script>
        ";
    }

}

// Tutup koneksi
mysqli_close($koneksi);
?>
