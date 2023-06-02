<?php

$conn = mysqli_connect("localhost","root","","phpdasar"); 

$code = $_GET['code'];

if(isset($code)) {
    $qry = $conn->query("SELECT * FROM mitraa WHERE verifikasi_code = '$code'");
    $result = $qry->fetch_assoc();

    $conn->query("UPDATE mitraa SET is_verif=1 WHERE id ='".$result['id']."'");

    echo "
        <script type='text/javascript'>
            alert('Verifikasi Berhasil, Silahkan Login!');
            window.location='loginMverif.php';
        </script>
        ";
}

?>