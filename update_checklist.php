<?php
// Koneksi database
$conn = mysqli_connect("localhost","root","","phpdasar"); 
// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Proses update checkbox
if (isset($_POST['checklist_sarapan']) && is_array($_POST['checklist_sarapan'])) {
    foreach ($_POST['checklist_sarapan'] as $id) {
      echo "
        <script type='text/javascript'>
            window.history.back();
        </script>
        ";
      $id = mysqli_real_escape_string($conn, $id);
      $query = "UPDATE loogbook SET checklist_sarapan=1 WHERE id=$id";
      mysqli_query($conn, $query);
    } 
}

// Proses update checkbox
if (isset($_POST['checklist_makan_siang']) && is_array($_POST['checklist_makan_siang'])) {
    foreach ($_POST['checklist_makan_siang'] as $id) {
      echo "
        <script type='text/javascript'>
            window.history.back();
        </script>
        ";
      $id = mysqli_real_escape_string($conn, $id);
      $query = "UPDATE loogbook SET checklist_makan_siang=1 WHERE id=$id";
      mysqli_query($conn, $query);
    } 
}

// Proses update checkbox
if (isset($_POST['checklist_olahraga']) && is_array($_POST['checklist_olahraga'])) {
    foreach ($_POST['checklist_olahraga'] as $id) {
      echo "
        <script type='text/javascript'>
            window.history.back();
        </script>
        ";
      $id = mysqli_real_escape_string($conn, $id);
      $query = "UPDATE loogbook SET checklist_olahraga=1 WHERE id=$id";
      mysqli_query($conn, $query);
    } 
}

// Proses update checkbox
if (isset($_POST['checklist_makan_malam']) && is_array($_POST['checklist_makan_malam'])) {
    foreach ($_POST['checklist_makan_malam'] as $id) {
      echo "
        <script type='text/javascript'>
            window.history.back();
        </script>
        ";
      $id = mysqli_real_escape_string($conn, $id);
      $query = "UPDATE loogbook SET checklist_makan_malam=1 WHERE id=$id";
      mysqli_query($conn, $query);
    } 
}

// Tutup koneksi
mysqli_close($conn);

?>






